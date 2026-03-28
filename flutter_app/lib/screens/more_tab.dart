import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import '../config/app_config.dart';
import '../config/theme.dart';
import '../services/auth_service.dart';
import '../models/user_model.dart';
import 'about_screen.dart';
import 'login_screen.dart';

class MoreTab extends StatefulWidget {
  const MoreTab({super.key});

  @override
  State<MoreTab> createState() => _MoreTabState();
}

class _MoreTabState extends State<MoreTab> {
  final _authService = AuthService();
  UserModel? _user;

  @override
  void initState() {
    super.initState();
    _user = _authService.currentUser;
  }

  Future<void> _logout() async {
    final confirmed = await showDialog<bool>(
      context: context,
      builder: (ctx) => AlertDialog(
        backgroundColor: AppColors.surface,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: const Text(
          'ออกจากระบบ',
          style: TextStyle(color: Colors.white),
        ),
        content: const Text(
          'คุณต้องการออกจากระบบหรือไม่?',
          style: TextStyle(color: AppColors.textSecondary),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(ctx, false),
            child: const Text(
              'ยกเลิก',
              style: TextStyle(color: AppColors.textMuted),
            ),
          ),
          ElevatedButton(
            onPressed: () => Navigator.pop(ctx, true),
            style: ElevatedButton.styleFrom(
              backgroundColor: AppColors.error,
            ),
            child: const Text('ออกจากระบบ'),
          ),
        ],
      ),
    );

    if (confirmed == true) {
      await _authService.logout();
      if (!mounted) return;
      Navigator.pushAndRemoveUntil(
        context,
        MaterialPageRoute(builder: (_) => const LoginScreen()),
        (route) => false,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('อื่นๆ'),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            // Profile section
            _buildProfileSection(),
            const SizedBox(height: 16),

            // Menu items
            _buildMenuSection(),
          ],
        ),
      ),
    );
  }

  Widget _buildProfileSection() {
    return Container(
      margin: const EdgeInsets.all(16),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        gradient: AppColors.cardGradient,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: AppColors.primary.withOpacity(0.2),
            blurRadius: 15,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: Row(
        children: [
          CircleAvatar(
            radius: 30,
            backgroundColor: AppColors.primary,
            child: Text(
              (_user?.name ?? 'U').substring(0, 1).toUpperCase(),
              style: const TextStyle(
                color: Colors.white,
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  _user?.name ?? 'ผู้ใช้',
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 4),
                if (_user?.memberCode != null)
                  Text(
                    'รหัสสมาชิก: ${_user!.memberCode}',
                    style: const TextStyle(
                      color: AppColors.textSecondary,
                      fontSize: 13,
                    ),
                  ),
                Text(
                  _user?.currentTenantName ?? '',
                  style: const TextStyle(
                    color: AppColors.textSecondary,
                    fontSize: 13,
                  ),
                ),
                const SizedBox(height: 4),
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 3),
                  decoration: BoxDecoration(
                    color: AppColors.primary.withOpacity(0.2),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Text(
                    _user?.currentRoleLabel ?? 'สมาชิก',
                    style: const TextStyle(
                      color: AppColors.primaryLight,
                      fontSize: 11,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildMenuSection() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16),
      child: Container(
        decoration: BoxDecoration(
          color: AppColors.surface,
          borderRadius: BorderRadius.circular(16),
        ),
        child: Column(
          children: [
            _buildMenuItem(
              icon: Icons.person_outline,
              label: 'โปรไฟล์',
              onTap: () {
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(content: Text('เร็วๆ นี้')),
                );
              },
            ),
            _buildMenuDivider(),
            _buildMenuItem(
              icon: Icons.show_chart,
              label: 'หุ้น',
              onTap: () {
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(content: Text('เร็วๆ นี้')),
                );
              },
            ),
            _buildMenuDivider(),
            if (_user != null && _user!.tenants.length > 1) ...[
              _buildMenuItem(
                icon: Icons.swap_horiz,
                label: 'เปลี่ยนกองทุน',
                onTap: _showTenantSwitcher,
              ),
              _buildMenuDivider(),
            ],
            _buildMenuItem(
              icon: Icons.menu_book_outlined,
              label: 'คู่มือการใช้งาน',
              iconColor: AppColors.primary,
              onTap: () async {
                final url = Uri.parse('${AppConfig.apiBaseUrl.replaceAll('/api', '')}/guide');
                if (await canLaunchUrl(url)) {
                  await launchUrl(url, mode: LaunchMode.externalApplication);
                }
              },
            ),
            _buildMenuDivider(),
            _buildMenuItem(
              icon: Icons.settings_outlined,
              label: 'ตั้งค่า',
              onTap: () {
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(content: Text('เร็วๆ นี้')),
                );
              },
            ),
            _buildMenuDivider(),
            _buildMenuItem(
              icon: Icons.info_outline,
              label: 'เกี่ยวกับ',
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (_) => const AboutScreen()),
                );
              },
            ),
            _buildMenuDivider(),
            _buildMenuItem(
              icon: Icons.logout,
              label: 'ออกจากระบบ',
              iconColor: AppColors.error,
              labelColor: AppColors.error,
              showChevron: false,
              onTap: _logout,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildMenuItem({
    required IconData icon,
    required String label,
    Color? iconColor,
    Color? labelColor,
    bool showChevron = true,
    required VoidCallback onTap,
  }) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(12),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
        child: Row(
          children: [
            Icon(
              icon,
              color: iconColor ?? AppColors.textSecondary,
              size: 22,
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                label,
                style: TextStyle(
                  color: labelColor ?? Colors.white,
                  fontSize: 15,
                ),
              ),
            ),
            if (showChevron)
              const Icon(
                Icons.chevron_right,
                color: AppColors.textMuted,
                size: 20,
              ),
          ],
        ),
      ),
    );
  }

  Widget _buildMenuDivider() {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16),
      child: Divider(
        color: AppColors.surfaceLight.withOpacity(0.3),
        height: 1,
      ),
    );
  }

  void _showTenantSwitcher() {
    if (_user == null) return;
    showModalBottomSheet(
      context: context,
      backgroundColor: AppColors.surface,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      builder: (ctx) {
        return Padding(
          padding: const EdgeInsets.all(20),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text(
                'เลือกกองทุน',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 16),
              ..._user!.tenants.map((tenant) {
                final isCurrent =
                    tenant.tenantName == _user!.currentTenantName;
                return ListTile(
                  leading: CircleAvatar(
                    backgroundColor: isCurrent
                        ? AppColors.primary
                        : AppColors.surfaceLight,
                    child: Icon(
                      Icons.account_balance,
                      color: isCurrent ? Colors.white : AppColors.textMuted,
                      size: 20,
                    ),
                  ),
                  title: Text(
                    tenant.tenantName,
                    style: TextStyle(
                      color: isCurrent ? AppColors.primary : Colors.white,
                      fontWeight:
                          isCurrent ? FontWeight.bold : FontWeight.normal,
                    ),
                  ),
                  subtitle: Text(
                    tenant.roleLabel,
                    style: const TextStyle(
                      color: AppColors.textMuted,
                      fontSize: 12,
                    ),
                  ),
                  trailing: isCurrent
                      ? const Icon(Icons.check_circle, color: AppColors.primary)
                      : null,
                  onTap: () async {
                    if (!isCurrent) {
                      await _authService.switchTenant(
                        tenant.tenantId.toString(),
                      );
                      if (!ctx.mounted) return;
                      Navigator.pop(ctx);
                      // Reload the app state
                      setState(() {});
                    }
                  },
                );
              }),
              const SizedBox(height: 8),
            ],
          ),
        );
      },
    );
  }
}
