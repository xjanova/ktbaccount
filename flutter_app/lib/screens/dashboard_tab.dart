import 'package:flutter/material.dart';
import 'package:fl_chart/fl_chart.dart';
import '../config/theme.dart';
import '../services/api_service.dart';
import '../services/auth_service.dart';
import '../models/user_model.dart';
import '../utils/formatters.dart';
import '../widgets/stat_card.dart';
import '../widgets/loading_widget.dart';

class DashboardTab extends StatefulWidget {
  const DashboardTab({super.key});

  @override
  State<DashboardTab> createState() => _DashboardTabState();
}

class _DashboardTabState extends State<DashboardTab> {
  final _api = ApiService();
  final _auth = AuthService();

  bool _isLoading = true;
  UserModel? _user;
  Map<String, dynamic> _summary = {};
  List<Map<String, dynamic>> _recentActivity = [];

  @override
  void initState() {
    super.initState();
    _loadData();
  }

  Future<void> _loadData() async {
    setState(() => _isLoading = true);
    try {
      _user = _auth.currentUser ?? await _auth.getUser();

      // Try to load dashboard summary
      try {
        _summary = await _api.get('/dashboard/summary');
      } catch (_) {
        // Use empty/mock data if endpoint not ready
        _summary = {
          'total_loans': 150000.0,
          'total_savings': 45000.0,
          'total_shares': 20000.0,
          'next_due_amount': 5200.0,
          'next_due_date': DateTime.now()
              .add(const Duration(days: 15))
              .toIso8601String(),
        };
      }

      // Try to load recent activity
      try {
        final activityResponse = await _api.get('/dashboard/activity');
        _recentActivity = List<Map<String, dynamic>>.from(
          activityResponse['data'] ?? [],
        );
      } catch (_) {
        _recentActivity = [];
      }
    } catch (_) {
      // Silently handle errors, show whatever data we have
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _isLoading
          ? const LoadingWidget(message: 'กำลังโหลดข้อมูล...')
          : RefreshIndicator(
              onRefresh: _loadData,
              color: AppColors.primary,
              child: CustomScrollView(
                slivers: [
                  // App Bar
                  SliverAppBar(
                    expandedHeight: 120,
                    floating: false,
                    pinned: true,
                    flexibleSpace: FlexibleSpaceBar(
                      background: Container(
                        decoration: const BoxDecoration(
                          gradient: LinearGradient(
                            begin: Alignment.topLeft,
                            end: Alignment.bottomRight,
                            colors: [Color(0xFF1E1B4B), AppColors.background],
                          ),
                        ),
                        child: SafeArea(
                          child: Padding(
                            padding: const EdgeInsets.fromLTRB(20, 16, 20, 0),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  children: [
                                    CircleAvatar(
                                      radius: 22,
                                      backgroundColor: AppColors.primary,
                                      child: Text(
                                        (_user?.name ?? 'U')
                                            .substring(0, 1)
                                            .toUpperCase(),
                                        style: const TextStyle(
                                          color: Colors.white,
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                    ),
                                    const SizedBox(width: 12),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Text(
                                            'สวัสดี, ${_user?.name ?? 'ผู้ใช้'}',
                                            style: const TextStyle(
                                              color: Colors.white,
                                              fontSize: 18,
                                              fontWeight: FontWeight.bold,
                                              height: 1.5,
                                            ),
                                          ),
                                          Text(
                                            _user?.currentTenantName ??
                                                'กองทุนหมู่บ้าน',
                                            style: const TextStyle(
                                              color: AppColors.textSecondary,
                                              fontSize: 13,
                                              height: 1.3,
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                    IconButton(
                                      icon: const Icon(
                                        Icons.notifications_outlined,
                                        color: AppColors.textSecondary,
                                      ),
                                      onPressed: () {},
                                    ),
                                  ],
                                ),
                              ],
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),

                  // Summary Cards
                  SliverPadding(
                    padding: const EdgeInsets.all(16),
                    sliver: SliverGrid(
                      gridDelegate:
                          const SliverGridDelegateWithFixedCrossAxisCount(
                        crossAxisCount: 2,
                        childAspectRatio: 1.35,
                        crossAxisSpacing: 12,
                        mainAxisSpacing: 12,
                      ),
                      delegate: SliverChildListDelegate([
                        StatCard(
                          icon: Icons.account_balance,
                          label: 'ยอดสินเชื่อ',
                          value: Formatters.currency(
                            (_summary['total_loans'] as num?)?.toDouble() ?? 0,
                          ),
                          gradient: AppColors.cardGradient,
                          iconColor: AppColors.primary,
                        ),
                        StatCard(
                          icon: Icons.savings,
                          label: 'ยอดเงินฝาก',
                          value: Formatters.currency(
                            (_summary['total_savings'] as num?)?.toDouble() ??
                                0,
                          ),
                          gradient: const LinearGradient(
                            colors: [Color(0xFF064E3B), Color(0xFF065F46)],
                          ),
                          iconColor: AppColors.success,
                        ),
                        StatCard(
                          icon: Icons.show_chart,
                          label: 'ยอดหุ้น',
                          value: Formatters.currency(
                            (_summary['total_shares'] as num?)?.toDouble() ?? 0,
                          ),
                          gradient: const LinearGradient(
                            colors: [Color(0xFF4C1D95), Color(0xFF5B21B6)],
                          ),
                          iconColor: AppColors.accent,
                        ),
                        StatCard(
                          icon: Icons.event,
                          label: 'งวดถัดไป',
                          value: Formatters.currency(
                            (_summary['next_due_amount'] as num?)?.toDouble() ??
                                0,
                          ),
                          gradient: const LinearGradient(
                            colors: [Color(0xFF78350F), Color(0xFF92400E)],
                          ),
                          iconColor: AppColors.warning,
                        ),
                      ]),
                    ),
                  ),

                  // Chart section
                  SliverToBoxAdapter(
                    child: Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      child: Container(
                        padding: const EdgeInsets.all(16),
                        decoration: BoxDecoration(
                          color: AppColors.surface,
                          borderRadius: BorderRadius.circular(16),
                        ),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const Text(
                              'รายรับ-รายจ่าย',
                              style: TextStyle(
                                color: Colors.white,
                                fontSize: 16,
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                            const SizedBox(height: 4),
                            const Text(
                              '6 เดือนล่าสุด',
                              style: TextStyle(
                                color: AppColors.textMuted,
                                fontSize: 12,
                              ),
                            ),
                            const SizedBox(height: 16),
                            SizedBox(
                              height: 200,
                              child: _buildChart(),
                            ),
                            const SizedBox(height: 12),
                            Row(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                _buildLegend(AppColors.primary, 'รายรับ'),
                                const SizedBox(width: 24),
                                _buildLegend(AppColors.error, 'รายจ่าย'),
                              ],
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),

                  // Recent Activity
                  const SliverToBoxAdapter(
                    child: Padding(
                      padding: EdgeInsets.fromLTRB(16, 24, 16, 8),
                      child: Text(
                        'กิจกรรมล่าสุด',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ),
                  SliverPadding(
                    padding:
                        const EdgeInsets.symmetric(horizontal: 16),
                    sliver: _recentActivity.isEmpty
                        ? SliverToBoxAdapter(
                            child: Container(
                              padding: const EdgeInsets.all(24),
                              decoration: BoxDecoration(
                                color: AppColors.surface,
                                borderRadius: BorderRadius.circular(16),
                              ),
                              child: const Center(
                                child: Text(
                                  'ยังไม่มีกิจกรรม',
                                  style: TextStyle(
                                    color: AppColors.textMuted,
                                    fontSize: 14,
                                  ),
                                ),
                              ),
                            ),
                          )
                        : SliverList(
                            delegate: SliverChildBuilderDelegate(
                              (context, index) {
                                final item = _recentActivity[index];
                                return _buildActivityItem(item);
                              },
                              childCount: _recentActivity.length,
                            ),
                          ),
                  ),
                  const SliverToBoxAdapter(child: SizedBox(height: 24)),
                ],
              ),
            ),
    );
  }

  Widget _buildChart() {
    // Sample data for chart
    final months = ['ต.ค.', 'พ.ย.', 'ธ.ค.', 'ม.ค.', 'ก.พ.', 'มี.ค.'];
    final income = [45.0, 52.0, 48.0, 55.0, 50.0, 60.0]; // x1000
    final expense = [30.0, 35.0, 32.0, 38.0, 28.0, 42.0]; // x1000

    return BarChart(
      BarChartData(
        alignment: BarChartAlignment.spaceAround,
        maxY: 70,
        barTouchData: BarTouchData(
          touchTooltipData: BarTouchTooltipData(
            getTooltipColor: (_) => AppColors.surface,
            tooltipPadding: const EdgeInsets.all(8),
            getTooltipItem: (group, groupIndex, rod, rodIndex) {
              final value = rod.toY;
              final label = rodIndex == 0 ? 'รายรับ' : 'รายจ่าย';
              return BarTooltipItem(
                '$label\n฿${Formatters.number(value * 1000)}',
                const TextStyle(color: Colors.white, fontSize: 12),
              );
            },
          ),
        ),
        titlesData: FlTitlesData(
          show: true,
          bottomTitles: AxisTitles(
            sideTitles: SideTitles(
              showTitles: true,
              getTitlesWidget: (value, meta) {
                final index = value.toInt();
                if (index >= 0 && index < months.length) {
                  return Padding(
                    padding: const EdgeInsets.only(top: 8),
                    child: Text(
                      months[index],
                      style: const TextStyle(
                        color: AppColors.textMuted,
                        fontSize: 11,
                      ),
                    ),
                  );
                }
                return const SizedBox.shrink();
              },
            ),
          ),
          leftTitles: AxisTitles(
            sideTitles: SideTitles(
              showTitles: true,
              reservedSize: 35,
              getTitlesWidget: (value, meta) {
                return Text(
                  '${value.toInt()}k',
                  style: const TextStyle(
                    color: AppColors.textMuted,
                    fontSize: 10,
                  ),
                );
              },
              interval: 20,
            ),
          ),
          topTitles: const AxisTitles(
            sideTitles: SideTitles(showTitles: false),
          ),
          rightTitles: const AxisTitles(
            sideTitles: SideTitles(showTitles: false),
          ),
        ),
        gridData: FlGridData(
          show: true,
          drawVerticalLine: false,
          horizontalInterval: 20,
          getDrawingHorizontalLine: (value) {
            return FlLine(
              color: AppColors.surfaceLight.withOpacity(0.3),
              strokeWidth: 1,
            );
          },
        ),
        borderData: FlBorderData(show: false),
        barGroups: List.generate(months.length, (index) {
          return BarChartGroupData(
            x: index,
            barRods: [
              BarChartRodData(
                toY: income[index],
                color: AppColors.primary,
                width: 12,
                borderRadius: const BorderRadius.vertical(
                  top: Radius.circular(4),
                ),
              ),
              BarChartRodData(
                toY: expense[index],
                color: AppColors.error.withOpacity(0.7),
                width: 12,
                borderRadius: const BorderRadius.vertical(
                  top: Radius.circular(4),
                ),
              ),
            ],
          );
        }),
      ),
    );
  }

  Widget _buildLegend(Color color, String label) {
    return Row(
      children: [
        Container(
          width: 12,
          height: 12,
          decoration: BoxDecoration(
            color: color,
            borderRadius: BorderRadius.circular(3),
          ),
        ),
        const SizedBox(width: 6),
        Text(
          label,
          style: const TextStyle(
            color: AppColors.textSecondary,
            fontSize: 12,
          ),
        ),
      ],
    );
  }

  Widget _buildActivityItem(Map<String, dynamic> item) {
    final type = item['type'] as String? ?? '';
    final isIncome = type == 'income' || type == 'deposit' || type == 'repayment';

    return Container(
      margin: const EdgeInsets.only(bottom: 8),
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: AppColors.surface,
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: (isIncome ? AppColors.success : AppColors.error)
                  .withOpacity(0.15),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(
              isIncome ? Icons.arrow_downward : Icons.arrow_upward,
              color: isIncome ? AppColors.success : AppColors.error,
              size: 20,
            ),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  item['description'] as String? ?? '-',
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 14,
                    fontWeight: FontWeight.w500,
                  ),
                ),
                const SizedBox(height: 2),
                Text(
                  Formatters.relativeTime(item['created_at'] as String?),
                  style: const TextStyle(
                    color: AppColors.textMuted,
                    fontSize: 12,
                  ),
                ),
              ],
            ),
          ),
          Text(
            '${isIncome ? '+' : '-'}${Formatters.currency((item['amount'] as num?)?.toDouble() ?? 0)}',
            style: TextStyle(
              color: isIncome ? AppColors.success : AppColors.error,
              fontSize: 14,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}
