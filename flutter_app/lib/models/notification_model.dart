import 'package:flutter/material.dart';
import '../config/theme.dart';

class NotificationModel {
  final int id;
  final String title;
  final String body;
  final String type;
  final bool isRead;
  final String? actionUrl;
  final String? createdAt;

  NotificationModel({
    required this.id,
    required this.title,
    required this.body,
    required this.type,
    this.isRead = false,
    this.actionUrl,
    this.createdAt,
  });

  factory NotificationModel.fromJson(Map<String, dynamic> json) {
    return NotificationModel(
      id: json['id'] as int? ?? 0,
      title: json['title'] as String? ?? '',
      body: json['body'] as String? ?? json['message'] as String? ?? '',
      type: json['type'] as String? ?? 'general',
      isRead: json['is_read'] as bool? ??
          json['read_at'] != null,
      actionUrl: json['action_url'] as String?,
      createdAt: json['created_at'] as String?,
    );
  }

  IconData get typeIcon {
    switch (type) {
      case 'loan':
      case 'loan_due':
      case 'loan_approved':
        return Icons.account_balance;
      case 'savings':
      case 'deposit':
        return Icons.savings;
      case 'payment':
      case 'repayment':
        return Icons.payment;
      case 'share':
      case 'dividend':
        return Icons.show_chart;
      case 'announcement':
        return Icons.campaign;
      case 'system':
        return Icons.settings;
      default:
        return Icons.notifications;
    }
  }

  Color get typeColor {
    switch (type) {
      case 'loan':
      case 'loan_due':
        return AppColors.warning;
      case 'loan_approved':
        return AppColors.success;
      case 'savings':
      case 'deposit':
        return AppColors.info;
      case 'payment':
      case 'repayment':
        return AppColors.primary;
      case 'share':
      case 'dividend':
        return AppColors.accent;
      case 'announcement':
        return AppColors.warning;
      case 'system':
        return AppColors.textMuted;
      default:
        return AppColors.primary;
    }
  }
}
