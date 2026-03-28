class ShareModel {
  final int id;
  final int totalShares;
  final double shareValue;
  final double totalValue;
  final String? lastPurchaseDate;
  final List<ShareTransactionModel> transactions;

  ShareModel({
    required this.id,
    required this.totalShares,
    required this.shareValue,
    required this.totalValue,
    this.lastPurchaseDate,
    this.transactions = const [],
  });

  factory ShareModel.fromJson(Map<String, dynamic> json) {
    final txnList = <ShareTransactionModel>[];
    if (json['transactions'] != null) {
      for (final t in json['transactions'] as List<dynamic>) {
        txnList
            .add(ShareTransactionModel.fromJson(t as Map<String, dynamic>));
      }
    }

    return ShareModel(
      id: json['id'] as int? ?? 0,
      totalShares: json['total_shares'] as int? ?? 0,
      shareValue: _toDouble(json['share_value']),
      totalValue: _toDouble(json['total_value']),
      lastPurchaseDate: json['last_purchase_date'] as String?,
      transactions: txnList,
    );
  }

  static double _toDouble(dynamic value) {
    if (value == null) return 0.0;
    if (value is double) return value;
    if (value is int) return value.toDouble();
    if (value is String) return double.tryParse(value) ?? 0.0;
    return 0.0;
  }
}

class ShareTransactionModel {
  final int id;
  final String type;
  final int shares;
  final double amount;
  final String? transactionDate;

  ShareTransactionModel({
    required this.id,
    required this.type,
    required this.shares,
    required this.amount,
    this.transactionDate,
  });

  factory ShareTransactionModel.fromJson(Map<String, dynamic> json) {
    return ShareTransactionModel(
      id: json['id'] as int? ?? 0,
      type: json['type'] as String? ?? '',
      shares: json['shares'] as int? ?? 0,
      amount: ShareModel._toDouble(json['amount']),
      transactionDate: json['transaction_date'] as String?,
    );
  }

  String get typeLabel {
    switch (type) {
      case 'buy':
        return 'ซื้อหุ้น';
      case 'sell':
        return 'ขายหุ้น';
      case 'dividend':
        return 'ปันผล';
      default:
        return type;
    }
  }
}
