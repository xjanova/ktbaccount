import 'package:flutter/material.dart';
import '../config/theme.dart';
import '../services/api_service.dart';
import '../models/savings_model.dart';
import '../utils/formatters.dart';
import '../widgets/loading_widget.dart';
import '../widgets/empty_state.dart';

class SavingsTab extends StatefulWidget {
  const SavingsTab({super.key});

  @override
  State<SavingsTab> createState() => _SavingsTabState();
}

class _SavingsTabState extends State<SavingsTab> {
  final _api = ApiService();
  bool _isLoading = true;
  List<SavingsAccountModel> _accounts = [];
  int _selectedAccountIndex = 0;

  @override
  void initState() {
    super.initState();
    _loadAccounts();
  }

  Future<void> _loadAccounts() async {
    setState(() => _isLoading = true);
    try {
      final response = await _api.get('/savings');
      final data = response['data'] as List<dynamic>? ?? [];
      _accounts = data
          .map((e) =>
              SavingsAccountModel.fromJson(e as Map<String, dynamic>))
          .toList();
    } catch (_) {
      _accounts = _getSampleAccounts();
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  List<SavingsAccountModel> _getSampleAccounts() {
    return [
      SavingsAccountModel(
        id: 1,
        accountNumber: 'SA-0001-2569',
        accountType: 'savings',
        balance: 45000,
        interestRate: 3.0,
        transactions: [
          SavingsTransactionModel(
            id: 1,
            type: 'deposit',
            amount: 5000,
            balanceAfter: 45000,
            description: 'ฝากเงินประจำเดือน',
            transactionDate: DateTime.now()
                .subtract(const Duration(days: 2))
                .toIso8601String(),
          ),
          SavingsTransactionModel(
            id: 2,
            type: 'interest',
            amount: 112.50,
            balanceAfter: 40112.50,
            description: 'ดอกเบี้ยรายเดือน',
            transactionDate: DateTime.now()
                .subtract(const Duration(days: 30))
                .toIso8601String(),
          ),
          SavingsTransactionModel(
            id: 3,
            type: 'deposit',
            amount: 5000,
            balanceAfter: 40000,
            description: 'ฝากเงินประจำเดือน',
            transactionDate: DateTime.now()
                .subtract(const Duration(days: 32))
                .toIso8601String(),
          ),
          SavingsTransactionModel(
            id: 4,
            type: 'withdrawal',
            amount: 2000,
            balanceAfter: 35000,
            description: 'ถอนเงิน',
            transactionDate: DateTime.now()
                .subtract(const Duration(days: 45))
                .toIso8601String(),
          ),
        ],
      ),
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('เงินฝาก'),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh, color: AppColors.textSecondary),
            onPressed: _loadAccounts,
          ),
        ],
      ),
      body: _isLoading
          ? const LoadingWidget(message: 'กำลังโหลดข้อมูลเงินฝาก...')
          : _accounts.isEmpty
              ? const EmptyState(
                  icon: Icons.savings_outlined,
                  message: 'ยังไม่มีบัญชีเงินฝาก',
                )
              : RefreshIndicator(
                  onRefresh: _loadAccounts,
                  color: AppColors.primary,
                  child: SingleChildScrollView(
                    physics: const AlwaysScrollableScrollPhysics(),
                    child: Column(
                      children: [
                        // Account selector (if multiple)
                        if (_accounts.length > 1)
                          _buildAccountSelector(),

                        // Balance card
                        _buildBalanceCard(),

                        // Transaction list
                        _buildTransactionList(),
                      ],
                    ),
                  ),
                ),
    );
  }

  Widget _buildAccountSelector() {
    return Padding(
      padding: const EdgeInsets.fromLTRB(16, 8, 16, 0),
      child: SizedBox(
        height: 40,
        child: ListView.builder(
          scrollDirection: Axis.horizontal,
          itemCount: _accounts.length,
          itemBuilder: (context, index) {
            final isSelected = index == _selectedAccountIndex;
            return Padding(
              padding: const EdgeInsets.only(right: 8),
              child: ChoiceChip(
                label: Text(_accounts[index].accountTypeLabel),
                selected: isSelected,
                onSelected: (selected) {
                  if (selected) {
                    setState(() => _selectedAccountIndex = index);
                  }
                },
                selectedColor: AppColors.primary,
                backgroundColor: AppColors.surface,
                labelStyle: TextStyle(
                  color: isSelected ? Colors.white : AppColors.textSecondary,
                  fontSize: 13,
                ),
              ),
            );
          },
        ),
      ),
    );
  }

  Widget _buildBalanceCard() {
    final account = _accounts[_selectedAccountIndex];
    return Padding(
      padding: const EdgeInsets.all(16),
      child: Container(
        width: double.infinity,
        padding: const EdgeInsets.all(24),
        decoration: BoxDecoration(
          gradient: const LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [Color(0xFF064E3B), Color(0xFF065F46)],
          ),
          borderRadius: BorderRadius.circular(20),
          boxShadow: [
            BoxShadow(
              color: const Color(0xFF059669).withOpacity(0.3),
              blurRadius: 20,
              offset: const Offset(0, 8),
            ),
          ],
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  account.accountTypeLabel,
                  style: const TextStyle(
                    color: AppColors.textSecondary,
                    fontSize: 14,
                  ),
                ),
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Text(
                    account.accountNumber,
                    style: const TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 12,
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 16),
            const Text(
              'ยอดเงินฝากคงเหลือ',
              style: TextStyle(
                color: AppColors.textSecondary,
                fontSize: 13,
              ),
            ),
            const SizedBox(height: 4),
            Text(
              Formatters.currency(account.balance),
              style: const TextStyle(
                color: Colors.white,
                fontSize: 32,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 12),
            Row(
              children: [
                const Icon(Icons.trending_up, color: AppColors.success, size: 16),
                const SizedBox(width: 4),
                Text(
                  'ดอกเบี้ย ${Formatters.percentage(account.interestRate)}/ปี',
                  style: const TextStyle(
                    color: AppColors.success,
                    fontSize: 13,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildTransactionList() {
    final account = _accounts[_selectedAccountIndex];
    final transactions = account.transactions;

    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'ประวัติการทำรายการ',
            style: TextStyle(
              color: Colors.white,
              fontSize: 16,
              fontWeight: FontWeight.w600,
            ),
          ),
          const SizedBox(height: 12),
          if (transactions.isEmpty)
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(24),
              decoration: BoxDecoration(
                color: AppColors.surface,
                borderRadius: BorderRadius.circular(16),
              ),
              child: const Center(
                child: Text(
                  'ยังไม่มีรายการ',
                  style: TextStyle(color: AppColors.textMuted),
                ),
              ),
            )
          else
            ...transactions.map((txn) => _buildTransactionItem(txn)),
          const SizedBox(height: 16),
        ],
      ),
    );
  }

  Widget _buildTransactionItem(SavingsTransactionModel txn) {
    return Container(
      margin: const EdgeInsets.only(bottom: 8),
      padding: const EdgeInsets.all(14),
      decoration: BoxDecoration(
        color: AppColors.surface,
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: (txn.isCredit ? AppColors.success : AppColors.error)
                  .withOpacity(0.15),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(
              txn.isCredit ? Icons.arrow_downward : Icons.arrow_upward,
              color: txn.isCredit ? AppColors.success : AppColors.error,
              size: 18,
            ),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  txn.typeLabel,
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 14,
                    fontWeight: FontWeight.w500,
                  ),
                ),
                if (txn.description != null) ...[
                  const SizedBox(height: 2),
                  Text(
                    txn.description!,
                    style: const TextStyle(
                      color: AppColors.textMuted,
                      fontSize: 12,
                    ),
                  ),
                ],
                const SizedBox(height: 2),
                Text(
                  Formatters.thaiDate(txn.transactionDate ?? txn.createdAt),
                  style: const TextStyle(
                    color: AppColors.textMuted,
                    fontSize: 11,
                  ),
                ),
              ],
            ),
          ),
          Text(
            '${txn.isCredit ? '+' : '-'}${Formatters.currency(txn.amount)}',
            style: TextStyle(
              color: txn.isCredit ? AppColors.success : AppColors.error,
              fontSize: 14,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}
