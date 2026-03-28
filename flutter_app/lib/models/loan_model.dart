import 'package:flutter/material.dart';
import '../config/theme.dart';

class LoanModel {
  final int id;
  final String loanCode;
  final double principal;
  final double interestRate;
  final int termMonths;
  final double outstandingBalance;
  final double totalPaid;
  final String status;
  final String? dueDate;
  final String? approvedDate;
  final String? createdAt;
  final List<LoanScheduleModel> schedules;

  LoanModel({
    required this.id,
    required this.loanCode,
    required this.principal,
    required this.interestRate,
    required this.termMonths,
    required this.outstandingBalance,
    this.totalPaid = 0,
    required this.status,
    this.dueDate,
    this.approvedDate,
    this.createdAt,
    this.schedules = const [],
  });

  factory LoanModel.fromJson(Map<String, dynamic> json) {
    final scheduleList = <LoanScheduleModel>[];
    if (json['schedules'] != null) {
      for (final s in json['schedules'] as List<dynamic>) {
        scheduleList.add(LoanScheduleModel.fromJson(s as Map<String, dynamic>));
      }
    }

    return LoanModel(
      id: json['id'] as int? ?? 0,
      loanCode: json['loan_code'] as String? ?? '',
      principal: _toDouble(json['principal']),
      interestRate: _toDouble(json['interest_rate']),
      termMonths: json['term_months'] as int? ?? 0,
      outstandingBalance: _toDouble(json['outstanding_balance']),
      totalPaid: _toDouble(json['total_paid']),
      status: json['status'] as String? ?? 'pending',
      dueDate: json['due_date'] as String?,
      approvedDate: json['approved_date'] as String?,
      createdAt: json['created_at'] as String?,
      schedules: scheduleList,
    );
  }

  String get statusLabel {
    switch (status) {
      case 'active':
        return 'กำลังผ่อนชำระ';
      case 'pending':
        return 'รออนุมัติ';
      case 'approved':
        return 'อนุมัติแล้ว';
      case 'overdue':
        return 'ค้างชำระ';
      case 'completed':
        return 'ชำระครบ';
      case 'rejected':
        return 'ไม่อนุมัติ';
      case 'defaulted':
        return 'ผิดนัด';
      default:
        return status;
    }
  }

  Color get statusColor {
    switch (status) {
      case 'active':
        return AppColors.success;
      case 'pending':
        return AppColors.warning;
      case 'approved':
        return AppColors.info;
      case 'overdue':
        return AppColors.error;
      case 'completed':
        return AppColors.textMuted;
      case 'rejected':
        return AppColors.error;
      case 'defaulted':
        return const Color(0xFFDC2626);
      default:
        return AppColors.textMuted;
    }
  }

  double get progressPercent {
    if (principal <= 0) return 0;
    final paid = principal - outstandingBalance;
    return (paid / principal).clamp(0.0, 1.0);
  }

  static double _toDouble(dynamic value) {
    if (value == null) return 0.0;
    if (value is double) return value;
    if (value is int) return value.toDouble();
    if (value is String) return double.tryParse(value) ?? 0.0;
    return 0.0;
  }
}

class LoanScheduleModel {
  final int id;
  final int installmentNo;
  final String dueDate;
  final double principalAmount;
  final double interestAmount;
  final double totalAmount;
  final double? paidAmount;
  final String? paidDate;
  final String status;

  LoanScheduleModel({
    this.id = 0,
    required this.installmentNo,
    required this.dueDate,
    required this.principalAmount,
    required this.interestAmount,
    required this.totalAmount,
    this.paidAmount,
    this.paidDate,
    required this.status,
  });

  factory LoanScheduleModel.fromJson(Map<String, dynamic> json) {
    return LoanScheduleModel(
      id: json['id'] as int? ?? 0,
      installmentNo: json['installment_no'] as int? ?? 0,
      dueDate: json['due_date'] as String? ?? '',
      principalAmount: LoanModel._toDouble(json['principal_amount']),
      interestAmount: LoanModel._toDouble(json['interest_amount']),
      totalAmount: LoanModel._toDouble(json['total_amount']),
      paidAmount: json['paid_amount'] != null
          ? LoanModel._toDouble(json['paid_amount'])
          : null,
      paidDate: json['paid_date'] as String?,
      status: json['status'] as String? ?? 'pending',
    );
  }

  String get statusLabel {
    switch (status) {
      case 'paid':
        return 'ชำระแล้ว';
      case 'pending':
        return 'รอชำระ';
      case 'overdue':
        return 'เกินกำหนด';
      case 'partial':
        return 'ชำระบางส่วน';
      default:
        return status;
    }
  }

  Color get statusColor {
    switch (status) {
      case 'paid':
        return AppColors.success;
      case 'pending':
        return AppColors.warning;
      case 'overdue':
        return AppColors.error;
      case 'partial':
        return AppColors.info;
      default:
        return AppColors.textMuted;
    }
  }
}
