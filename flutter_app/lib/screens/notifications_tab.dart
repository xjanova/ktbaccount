import 'package:flutter/material.dart';
import '../config/theme.dart';
import '../services/api_service.dart';
import '../models/notification_model.dart';
import '../utils/formatters.dart';
import '../widgets/loading_widget.dart';
import '../widgets/empty_state.dart';

class NotificationsTab extends StatefulWidget {
  const NotificationsTab({super.key});

  @override
  State<NotificationsTab> createState() => _NotificationsTabState();
}

class _NotificationsTabState extends State<NotificationsTab> {
  final _api = ApiService();
  bool _isLoading = true;
  List<NotificationModel> _notifications = [];

  @override
  void initState() {
    super.initState();
    _loadNotifications();
  }

  Future<void> _loadNotifications() async {
    setState(() => _isLoading = true);
    try {
      final response = await _api.get('/notifications');
      final data = response['data'] as List<dynamic>? ?? [];
      _notifications = data
          .map((e) =>
              NotificationModel.fromJson(e as Map<String, dynamic>))
          .toList();
    } catch (_) {
      _notifications = _getSampleNotifications();
    } finally {
      if (mounted) setState(() => _isLoading = false);
    }
  }

  List<NotificationModel> _getSampleNotifications() {
    return [
      NotificationModel(
        id: 1,
        title: 'แจ้งเตือนชำระเงินกู้',
        body: 'งวดที่ 7 ของสัญญา LN-2569-0001 จะครบกำหนดชำระในอีก 5 วัน',
        type: 'loan_due',
        isRead: false,
        createdAt:
            DateTime.now().subtract(const Duration(hours: 2)).toIso8601String(),
      ),
      NotificationModel(
        id: 2,
        title: 'ฝากเงินสำเร็จ',
        body: 'ฝากเงินจำนวน 5,000 บาท เข้าบัญชี SA-0001-2569 เรียบร้อยแล้ว',
        type: 'deposit',
        isRead: false,
        createdAt:
            DateTime.now().subtract(const Duration(days: 1)).toIso8601String(),
      ),
      NotificationModel(
        id: 3,
        title: 'เงินปันผลประจำปี',
        body: 'กองทุนประกาศจ่ายเงินปันผลประจำปี 2568 จำนวน 1,200 บาท',
        type: 'dividend',
        isRead: true,
        createdAt:
            DateTime.now().subtract(const Duration(days: 7)).toIso8601String(),
      ),
      NotificationModel(
        id: 4,
        title: 'ประชุมสามัญประจำปี',
        body: 'ขอเชิญสมาชิกเข้าร่วมประชุมสามัญประจำปี 2569 วันที่ 15 เม.ย. 2569',
        type: 'announcement',
        isRead: true,
        createdAt: DateTime.now()
            .subtract(const Duration(days: 14))
            .toIso8601String(),
      ),
    ];
  }

  Future<void> _markAsRead(NotificationModel notification) async {
    if (notification.isRead) return;
    try {
      await _api.post('/notifications/${notification.id}/read', {});
    } catch (_) {
      // Silently handle
    }
    setState(() {
      final index = _notifications.indexWhere((n) => n.id == notification.id);
      if (index >= 0) {
        _notifications[index] = NotificationModel(
          id: notification.id,
          title: notification.title,
          body: notification.body,
          type: notification.type,
          isRead: true,
          actionUrl: notification.actionUrl,
          createdAt: notification.createdAt,
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final unreadCount = _notifications.where((n) => !n.isRead).length;

    return Scaffold(
      appBar: AppBar(
        title: Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            const Text('แจ้งเตือน'),
            if (unreadCount > 0) ...[
              const SizedBox(width: 8),
              Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                decoration: BoxDecoration(
                  color: AppColors.error,
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Text(
                  '$unreadCount',
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 12,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ],
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh, color: AppColors.textSecondary),
            onPressed: _loadNotifications,
          ),
        ],
      ),
      body: _isLoading
          ? const LoadingWidget(message: 'กำลังโหลดการแจ้งเตือน...')
          : _notifications.isEmpty
              ? const EmptyState(
                  icon: Icons.notifications_off_outlined,
                  message: 'ยังไม่มีการแจ้งเตือน',
                )
              : RefreshIndicator(
                  onRefresh: _loadNotifications,
                  color: AppColors.primary,
                  child: ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: _notifications.length,
                    itemBuilder: (context, index) {
                      return _buildNotificationItem(_notifications[index]);
                    },
                  ),
                ),
    );
  }

  Widget _buildNotificationItem(NotificationModel notification) {
    return GestureDetector(
      onTap: () => _markAsRead(notification),
      child: Container(
        margin: const EdgeInsets.only(bottom: 8),
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: notification.isRead
              ? AppColors.surface
              : AppColors.surface.withOpacity(0.8),
          borderRadius: BorderRadius.circular(12),
          border: notification.isRead
              ? null
              : Border.all(
                  color: AppColors.primary.withOpacity(0.3),
                  width: 1,
                ),
        ),
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Icon
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: notification.typeColor.withOpacity(0.15),
                borderRadius: BorderRadius.circular(10),
              ),
              child: Icon(
                notification.typeIcon,
                color: notification.typeColor,
                size: 20,
              ),
            ),
            const SizedBox(width: 12),
            // Content
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: [
                      Expanded(
                        child: Text(
                          notification.title,
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 14,
                            fontWeight: notification.isRead
                                ? FontWeight.w500
                                : FontWeight.w700,
                          ),
                        ),
                      ),
                      if (!notification.isRead)
                        Container(
                          width: 8,
                          height: 8,
                          decoration: const BoxDecoration(
                            color: AppColors.primary,
                            shape: BoxShape.circle,
                          ),
                        ),
                    ],
                  ),
                  const SizedBox(height: 4),
                  Text(
                    notification.body,
                    style: const TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 13,
                      height: 1.4,
                    ),
                    maxLines: 3,
                    overflow: TextOverflow.ellipsis,
                  ),
                  const SizedBox(height: 6),
                  Text(
                    Formatters.relativeTime(notification.createdAt),
                    style: const TextStyle(
                      color: AppColors.textMuted,
                      fontSize: 11,
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
