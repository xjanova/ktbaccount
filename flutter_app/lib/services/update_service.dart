import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:path_provider/path_provider.dart';
import 'package:url_launcher/url_launcher.dart';
import '../config/app_config.dart';
import '../config/theme.dart';

class UpdateService {
  static final UpdateService _instance = UpdateService._internal();
  factory UpdateService() => _instance;
  UpdateService._internal();

  /// Check GitHub releases API for latest version.
  /// Returns null if no update available or on error.
  Future<Map<String, dynamic>?> checkForUpdate() async {
    try {
      final response = await http
          .get(
            Uri.parse(AppConfig.githubApiUrl),
            headers: {'Accept': 'application/vnd.github.v3+json'},
          )
          .timeout(const Duration(seconds: 15));

      if (response.statusCode != 200) return null;

      final data = jsonDecode(response.body) as Map<String, dynamic>;
      final tagName = (data['tag_name'] as String? ?? '').replaceAll('v', '');

      if (!isNewerVersion(tagName, AppConfig.appVersion)) return null;

      // Find APK asset
      String? downloadUrl;
      final assets = data['assets'] as List<dynamic>? ?? [];
      for (final asset in assets) {
        final name = asset['name'] as String? ?? '';
        if (name.endsWith('.apk')) {
          downloadUrl = asset['browser_download_url'] as String?;
          break;
        }
      }

      return {
        'version': tagName,
        'name': data['name'] ?? 'v$tagName',
        'body': data['body'] ?? '',
        'download_url': downloadUrl,
        'html_url': data['html_url'] ?? '',
      };
    } catch (e) {
      return null;
    }
  }

  /// Compare semantic versions. Returns true if remote > local.
  bool isNewerVersion(String remote, String local) {
    try {
      final remoteParts = remote.split('.').map(int.parse).toList();
      final localParts = local.split('.').map(int.parse).toList();

      for (int i = 0; i < 3; i++) {
        final r = i < remoteParts.length ? remoteParts[i] : 0;
        final l = i < localParts.length ? localParts[i] : 0;
        if (r > l) return true;
        if (r < l) return false;
      }
      return false;
    } catch (e) {
      return false;
    }
  }

  /// Download APK and open for install (Android only).
  Future<void> downloadAndInstall(String downloadUrl) async {
    if (!Platform.isAndroid) {
      // On non-Android, open browser to download page
      final uri = Uri.parse(downloadUrl);
      if (await canLaunchUrl(uri)) {
        await launchUrl(uri, mode: LaunchMode.externalApplication);
      }
      return;
    }

    try {
      final dir = await getTemporaryDirectory();
      final filePath = '${dir.path}/ktbaccount_update.apk';
      final file = File(filePath);

      final response = await http.get(Uri.parse(downloadUrl));
      await file.writeAsBytes(response.bodyBytes);

      // Open APK for install via intent
      // In production, use android_intent_plus or open_filex package
      // For now, open the release page
      final uri = Uri.parse(downloadUrl);
      if (await canLaunchUrl(uri)) {
        await launchUrl(uri, mode: LaunchMode.externalApplication);
      }
    } catch (e) {
      // Fallback: open browser
      final uri = Uri.parse(downloadUrl);
      if (await canLaunchUrl(uri)) {
        await launchUrl(uri, mode: LaunchMode.externalApplication);
      }
    }
  }

  /// Show update dialog.
  static void showUpdateDialog(
    BuildContext context,
    Map<String, dynamic> updateInfo,
  ) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (ctx) => AlertDialog(
        backgroundColor: AppColors.surface,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: const Row(
          children: [
            Icon(Icons.system_update, color: AppColors.primary),
            SizedBox(width: 8),
            Text(
              'อัพเดทใหม่',
              style: TextStyle(color: Colors.white),
            ),
          ],
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'เวอร์ชัน ${updateInfo['version']}',
              style: const TextStyle(
                color: AppColors.primary,
                fontWeight: FontWeight.bold,
                fontSize: 16,
              ),
            ),
            const SizedBox(height: 8),
            if (updateInfo['body'] != null &&
                (updateInfo['body'] as String).isNotEmpty)
              Text(
                updateInfo['body'],
                style: const TextStyle(
                  color: AppColors.textSecondary,
                  fontSize: 14,
                ),
                maxLines: 6,
                overflow: TextOverflow.ellipsis,
              ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(ctx),
            child: const Text(
              'ภายหลัง',
              style: TextStyle(color: AppColors.textMuted),
            ),
          ),
          ElevatedButton(
            onPressed: () {
              Navigator.pop(ctx);
              final url = updateInfo['download_url'] ?? updateInfo['html_url'];
              if (url != null) {
                UpdateService().downloadAndInstall(url);
              }
            },
            child: const Text('อัพเดทเลย'),
          ),
        ],
      ),
    );
  }
}
