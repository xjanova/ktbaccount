import 'package:flutter/material.dart';
import '../config/theme.dart';
import '../models/loan_model.dart';
import '../services/api_service.dart';
import '../utils/formatters.dart';
import '../widgets/loading_widget.dart';

class LoanDetailScreen extends StatefulWidget {
  final LoanModel loan;

  const LoanDetailScreen({super.key, required this.loan});

  @override
  State<LoanDetailScreen> createState() => _LoanDetailScreenState();
}

class _LoanDetailScreenState extends State<LoanDetailScreen> {
  final _api = ApiService();
  bool _isLoading = false;
  late LoanModel _loan;
  List<LoanScheduleModel> _schedules = [];

  @override
  void initState() {
    super.initState();
    _loan = widget.loan;
    _loadSchedules();
  }

  Future<void> _loadSchedules() async {
    setState(() => _isLoading = true);
    try {
      final response = await _api.get('/loans/${_loan.id}/schedules');
      final data = response['data'] as List<dynamic>? ?? [];
      _schedules = data
          .map((e) => LoanScheduleModel.fromJson(e as Map<String, dynamic>))
          .toList();
    } catch (_) {
      // Use sample schedules
      _schedules = _getSampleSchedules();
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  List<LoanScheduleModel> _getSampleSchedules() {
    final list = <LoanScheduleModel>[];
    final monthlyPrincipal = _loan.principal / _loan.termMonths;
    double remaining = _loan.principal;

    for (int i = 1; i <= _loan.termMonths; i++) {
      final interest = remaining * (_loan.interestRate / 100 / 12);
      final total = monthlyPrincipal + interest;
      final dueDate =
          DateTime.now().add(Duration(days: 30 * (i - _loan.termMonths + 6)));

      String status;
      if (i <= (_loan.termMonths * _loan.progressPercent).round()) {
        status = 'paid';
      } else if (dueDate.isBefore(DateTime.now())) {
        status = 'overdue';
      } else {
        status = 'pending';
      }

      list.add(LoanScheduleModel(
        id: i,
        installmentNo: i,
        dueDate: dueDate.toIso8601String(),
        principalAmount: monthlyPrincipal,
        interestAmount: interest,
        totalAmount: total,
        status: status,
      ));
      remaining -= monthlyPrincipal;
    }
    return list;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(_loan.loanCode),
      ),
      body: _isLoading
          ? const LoadingWidget(message: 'กำลังโหลดตารางผ่อนชำระ...')
          : SingleChildScrollView(
              child: Column(
                children: [
                  // Loan summary header
                  _buildSummaryHeader(),
                  const SizedBox(height: 16),

                  // Info cards
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 16),
                    child: _buildInfoSection(),
                  ),
                  const SizedBox(height: 16),

                  // Schedule table
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 16),
                    child: _buildScheduleSection(),
                  ),
                  const SizedBox(height: 24),
                ],
              ),
            ),
    );
  }

  Widget _buildSummaryHeader() {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(20),
      decoration: const BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [Color(0xFF1E1B4B), Color(0xFF312E81)],
        ),
      ),
      child: Column(
        children: [
          // Status badge
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 6),
            decoration: BoxDecoration(
              color: _loan.statusColor.withOpacity(0.2),
              borderRadius: BorderRadius.circular(20),
            ),
            child: Text(
              _loan.statusLabel,
              style: TextStyle(
                color: _loan.statusColor,
                fontSize: 14,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
          const SizedBox(height: 16),

          // Outstanding balance
          const Text(
            'ยอดคงเหลือ',
            style: TextStyle(
              color: AppColors.textSecondary,
              fontSize: 14,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            Formatters.currency(_loan.outstandingBalance),
            style: const TextStyle(
              color: Colors.white,
              fontSize: 32,
              fontWeight: FontWeight.bold,
            ),
          ),
          const SizedBox(height: 16),

          // Progress
          Column(
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Text(
                    'ชำระแล้ว',
                    style: TextStyle(color: AppColors.textSecondary, fontSize: 12),
                  ),
                  Text(
                    '${(_loan.progressPercent * 100).toStringAsFixed(1)}%',
                    style: const TextStyle(
                      color: AppColors.primaryLight,
                      fontSize: 12,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 8),
              ClipRRect(
                borderRadius: BorderRadius.circular(6),
                child: LinearProgressIndicator(
                  value: _loan.progressPercent,
                  backgroundColor: Colors.white.withOpacity(0.1),
                  valueColor:
                      const AlwaysStoppedAnimation<Color>(AppColors.primary),
                  minHeight: 10,
                ),
              ),
              const SizedBox(height: 8),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    Formatters.currency(
                      _loan.principal - _loan.outstandingBalance,
                    ),
                    style: const TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                    ),
                  ),
                  Text(
                    Formatters.currency(_loan.principal),
                    style: const TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                    ),
                  ),
                ],
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildInfoSection() {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: AppColors.surface,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        children: [
          _buildInfoRow('เงินต้น', Formatters.currency(_loan.principal)),
          _buildDivider(),
          _buildInfoRow(
            'อัตราดอกเบี้ย',
            '${Formatters.percentage(_loan.interestRate)}/ปี',
          ),
          _buildDivider(),
          _buildInfoRow('ระยะเวลา', '${_loan.termMonths} เดือน'),
          _buildDivider(),
          _buildInfoRow(
            'วันที่อนุมัติ',
            Formatters.thaiDate(_loan.approvedDate ?? _loan.createdAt),
          ),
          if (_loan.dueDate != null) ...[
            _buildDivider(),
            _buildInfoRow(
              'งวดถัดไป',
              Formatters.thaiDate(_loan.dueDate),
            ),
          ],
        ],
      ),
    );
  }

  Widget _buildInfoRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(
            label,
            style: const TextStyle(
              color: AppColors.textSecondary,
              fontSize: 14,
            ),
          ),
          Text(
            value,
            style: const TextStyle(
              color: Colors.white,
              fontSize: 14,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildDivider() {
    return Divider(
      color: AppColors.surfaceLight.withOpacity(0.5),
      height: 1,
    );
  }

  Widget _buildScheduleSection() {
    return Container(
      decoration: BoxDecoration(
        color: AppColors.surface,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Padding(
            padding: EdgeInsets.all(16),
            child: Text(
              'ตารางผ่อนชำระ',
              style: TextStyle(
                color: Colors.white,
                fontSize: 16,
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
          // Table header
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
            color: AppColors.surfaceLight.withOpacity(0.3),
            child: const Row(
              children: [
                SizedBox(
                  width: 40,
                  child: Text(
                    'งวด',
                    style: TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
                Expanded(
                  child: Text(
                    'วันครบกำหนด',
                    style: TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
                SizedBox(
                  width: 80,
                  child: Text(
                    'ยอดชำระ',
                    textAlign: TextAlign.right,
                    style: TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
                SizedBox(
                  width: 70,
                  child: Text(
                    'สถานะ',
                    textAlign: TextAlign.right,
                    style: TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
              ],
            ),
          ),
          // Table rows
          ListView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: _schedules.length,
            itemBuilder: (context, index) {
              final s = _schedules[index];
              return Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                decoration: BoxDecoration(
                  border: Border(
                    bottom: BorderSide(
                      color: AppColors.surfaceLight.withOpacity(0.2),
                    ),
                  ),
                ),
                child: Row(
                  children: [
                    SizedBox(
                      width: 40,
                      child: Text(
                        '${s.installmentNo}',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 13,
                        ),
                      ),
                    ),
                    Expanded(
                      child: Text(
                        Formatters.thaiDate(s.dueDate),
                        style: const TextStyle(
                          color: AppColors.textSecondary,
                          fontSize: 13,
                        ),
                      ),
                    ),
                    SizedBox(
                      width: 80,
                      child: Text(
                        Formatters.currency(s.totalAmount),
                        textAlign: TextAlign.right,
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 13,
                        ),
                      ),
                    ),
                    SizedBox(
                      width: 70,
                      child: Align(
                        alignment: Alignment.centerRight,
                        child: Container(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 8,
                            vertical: 2,
                          ),
                          decoration: BoxDecoration(
                            color: s.statusColor.withOpacity(0.15),
                            borderRadius: BorderRadius.circular(12),
                          ),
                          child: Text(
                            s.statusLabel,
                            style: TextStyle(
                              color: s.statusColor,
                              fontSize: 11,
                              fontWeight: FontWeight.w600,
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              );
            },
          ),
        ],
      ),
    );
  }
}
