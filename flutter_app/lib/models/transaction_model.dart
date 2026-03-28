import 'package:flutter/material.dart';
import '../config/theme.dart';

class TransactionModel {
  final int id;
  final String type;
  final String category;
  final double amount;
  final String? description;
  final String? referenceNo;
  final String status;
  final String? transactionDate;
  final String? createdAt;

  TransactionModel({
    required this.id,
    required this.type,
    required this.category,
    required this.amount,
    this.description,
    this.referenceNo,
    this.status = 'completed',
    this.transactionDate,
    this.createdAt,
  });

  factory TransactionModel.fromJson(Map<String, dynamic> json) {
    return TransactionModel(
      id: json['id'] as int? ?? 0,
      type: json['type'] as String? ?? '',
      category: json['category'] as String? ?? '',
      amount: _toDouble(json['amount']),
      description: json['description'] as String?,
      referenceNo: json['reference_no'] as String?,
      status: json['status'] as String? ?? 'completed',
      transactionDate: json['transaction_date'] as String?,
      createdAt: json['created_at'] as String?,
    );
  }

  bool get isIncome =>
      type == 'income' || type == 'deposit' || type == 'repayment';

  String get typeLabel {
    switch (type) {
      case 'income':
        return 'รายรับ';
      case 'expense':
        return 'รายจ่าย';
      case 'deposit':
        return 'ฝากเงิน';
      case 'withdrawal':
        return 'ถอนเงิน';
      case 'loan_disbursement':
        return 'จ่ายเงินกู้';
      case 'repayment':
        return 'ชำระเงินกู้';
      case 'share_purchase':
        return 'ซื้อหุ้น';
      case 'dividend':
        return 'เงินปันผล';
      default:
        return type;
    }
  }

  IconData get typeIcon {
    switch (type) {
      case 'income':
      case 'deposit':
      case 'repayment':
        return Icons.arrow_downward;
      case 'expense':
      case 'withdrawal':
      case 'loan_disbursement':
        return Icons.arrow_upward;
      case 'share_purchase':
        return Icons.show_chart;
      case 'dividend':
        return Icons.card_giftcard;
      default:
        return Icons.swap_horiz;
    }
  }

  Color get typeColor => isIncome ? AppColors.success : AppColors.error;

  static double _toDouble(dynamic value) {
    if (value == null) return 0.0;
    if (value is double) return value;
    if (value is int) return value.toDouble();
    if (value is String) return double.tryParse(value) ?? 0.0;
    return 0.0;
  }
}
