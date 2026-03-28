class SavingsAccountModel {
  final int id;
  final String accountNumber;
  final String accountType;
  final double balance;
  final double interestRate;
  final String status;
  final String? createdAt;
  final List<SavingsTransactionModel> transactions;

  SavingsAccountModel({
    required this.id,
    required this.accountNumber,
    required this.accountType,
    required this.balance,
    this.interestRate = 0,
    this.status = 'active',
    this.createdAt,
    this.transactions = const [],
  });

  factory SavingsAccountModel.fromJson(Map<String, dynamic> json) {
    final txnList = <SavingsTransactionModel>[];
    if (json['transactions'] != null) {
      for (final t in json['transactions'] as List<dynamic>) {
        txnList
            .add(SavingsTransactionModel.fromJson(t as Map<String, dynamic>));
      }
    }

    return SavingsAccountModel(
      id: json['id'] as int? ?? 0,
      accountNumber: json['account_number'] as String? ?? '',
      accountType: json['account_type'] as String? ?? 'savings',
      balance: _toDouble(json['balance']),
      interestRate: _toDouble(json['interest_rate']),
      status: json['status'] as String? ?? 'active',
      createdAt: json['created_at'] as String?,
      transactions: txnList,
    );
  }

  String get accountTypeLabel {
    switch (accountType) {
      case 'savings':
        return 'เงินฝากออมทรัพย์';
      case 'fixed':
        return 'เงินฝากประจำ';
      case 'special':
        return 'เงินฝากพิเศษ';
      default:
        return accountType;
    }
  }

  static double _toDouble(dynamic value) {
    if (value == null) return 0.0;
    if (value is double) return value;
    if (value is int) return value.toDouble();
    if (value is String) return double.tryParse(value) ?? 0.0;
    return 0.0;
  }
}

class SavingsTransactionModel {
  final int id;
  final String type;
  final double amount;
  final double balanceAfter;
  final String? description;
  final String? transactionDate;
  final String? createdAt;

  SavingsTransactionModel({
    required this.id,
    required this.type,
    required this.amount,
    this.balanceAfter = 0,
    this.description,
    this.transactionDate,
    this.createdAt,
  });

  factory SavingsTransactionModel.fromJson(Map<String, dynamic> json) {
    return SavingsTransactionModel(
      id: json['id'] as int? ?? 0,
      type: json['type'] as String? ?? '',
      amount: SavingsAccountModel._toDouble(json['amount']),
      balanceAfter: SavingsAccountModel._toDouble(json['balance_after']),
      description: json['description'] as String?,
      transactionDate: json['transaction_date'] as String?,
      createdAt: json['created_at'] as String?,
    );
  }

  String get typeLabel {
    switch (type) {
      case 'deposit':
        return 'ฝากเงิน';
      case 'withdrawal':
        return 'ถอนเงิน';
      case 'interest':
        return 'ดอกเบี้ย';
      case 'transfer':
        return 'โอนเงิน';
      default:
        return type;
    }
  }

  bool get isCredit =>
      type == 'deposit' || type == 'interest' || type == 'transfer_in';
}
