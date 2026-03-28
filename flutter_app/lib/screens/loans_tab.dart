import 'package:flutter/material.dart';
import '../config/theme.dart';
import '../services/api_service.dart';
import '../models/loan_model.dart';
import '../widgets/loan_card.dart';
import '../widgets/loading_widget.dart';
import '../widgets/empty_state.dart';
import 'loan_detail_screen.dart';

class LoansTab extends StatefulWidget {
  const LoansTab({super.key});

  @override
  State<LoansTab> createState() => _LoansTabState();
}

class _LoansTabState extends State<LoansTab> {
  final _api = ApiService();
  bool _isLoading = true;
  List<LoanModel> _loans = [];

  @override
  void initState() {
    super.initState();
    _loadLoans();
  }

  Future<void> _loadLoans() async {
    setState(() {
      _isLoading = true;
    });

    try {
      final response = await _api.get('/loans');
      final data = response['data'] as List<dynamic>? ?? [];
      _loans = data
          .map((e) => LoanModel.fromJson(e as Map<String, dynamic>))
          .toList();
    } on ApiException {
      // Use sample data for demo
      _loans = _getSampleLoans();
    } catch (_) {
      _loans = _getSampleLoans();
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  List<LoanModel> _getSampleLoans() {
    return [
      LoanModel(
        id: 1,
        loanCode: 'LN-2569-0001',
        principal: 100000,
        interestRate: 12,
        termMonths: 24,
        outstandingBalance: 75000,
        status: 'active',
        dueDate: DateTime.now().add(const Duration(days: 15)).toIso8601String(),
      ),
      LoanModel(
        id: 2,
        loanCode: 'LN-2569-0002',
        principal: 50000,
        interestRate: 10,
        termMonths: 12,
        outstandingBalance: 0,
        status: 'completed',
      ),
      LoanModel(
        id: 3,
        loanCode: 'LN-2568-0015',
        principal: 30000,
        interestRate: 12,
        termMonths: 6,
        outstandingBalance: 12500,
        status: 'overdue',
        dueDate: DateTime.now()
            .subtract(const Duration(days: 5))
            .toIso8601String(),
      ),
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('สินเชื่อ'),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh, color: AppColors.textSecondary),
            onPressed: _loadLoans,
          ),
        ],
      ),
      body: _isLoading
          ? const LoadingWidget(message: 'กำลังโหลดข้อมูลสินเชื่อ...')
          : _loans.isEmpty
              ? const EmptyState(
                  icon: Icons.account_balance_outlined,
                  message: 'ยังไม่มีข้อมูลสินเชื่อ',
                )
              : RefreshIndicator(
                  onRefresh: _loadLoans,
                  color: AppColors.primary,
                  child: ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: _loans.length,
                    itemBuilder: (context, index) {
                      final loan = _loans[index];
                      return LoanCard(
                        loan: loan,
                        onTap: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (_) => LoanDetailScreen(loan: loan),
                            ),
                          );
                        },
                      );
                    },
                  ),
                ),
    );
  }
}
