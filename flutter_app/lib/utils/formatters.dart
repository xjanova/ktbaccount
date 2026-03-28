import 'package:intl/intl.dart';

class Formatters {
  static const List<String> thaiMonths = [
    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน',
    'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
    'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม',
  ];

  static const List<String> thaiMonthsShort = [
    'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.',
    'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.',
    'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.',
  ];

  /// Format Thai Baht: ฿1,234,567.89
  static String currency(double? amount) {
    if (amount == null) return '฿0.00';
    final formatter = NumberFormat('#,##0.00', 'en_US');
    return '฿${formatter.format(amount)}';
  }

  /// Format currency without symbol: 1,234,567.89
  static String number(double? amount) {
    if (amount == null) return '0.00';
    final formatter = NumberFormat('#,##0.00', 'en_US');
    return formatter.format(amount);
  }

  /// Format integer with commas: 1,234,567
  static String integer(int? value) {
    if (value == null) return '0';
    final formatter = NumberFormat('#,##0', 'en_US');
    return formatter.format(value);
  }

  /// Format Thai date: 28 มี.ค. 2569
  static String thaiDate(String? isoDate) {
    if (isoDate == null || isoDate.isEmpty) return '-';
    try {
      final date = DateTime.parse(isoDate);
      final thaiYear = date.year + 543;
      return '${date.day} ${thaiMonthsShort[date.month - 1]} $thaiYear';
    } catch (e) {
      return isoDate;
    }
  }

  /// Format Thai full date: 28 มีนาคม 2569
  static String thaiDateFull(String? isoDate) {
    if (isoDate == null || isoDate.isEmpty) return '-';
    try {
      final date = DateTime.parse(isoDate);
      final thaiYear = date.year + 543;
      return '${date.day} ${thaiMonths[date.month - 1]} $thaiYear';
    } catch (e) {
      return isoDate;
    }
  }

  /// Format relative time in Thai
  static String relativeTime(String? isoDate) {
    if (isoDate == null || isoDate.isEmpty) return '-';
    try {
      final date = DateTime.parse(isoDate);
      final now = DateTime.now();
      final diff = now.difference(date);

      if (diff.inMinutes < 1) return 'เมื่อสักครู่';
      if (diff.inMinutes < 60) return '${diff.inMinutes} นาทีที่แล้ว';
      if (diff.inHours < 24) return '${diff.inHours} ชั่วโมงที่แล้ว';
      if (diff.inDays < 7) return '${diff.inDays} วันที่แล้ว';
      return thaiDate(isoDate);
    } catch (e) {
      return isoDate;
    }
  }

  /// Format percentage: 12.50%
  static String percentage(double? value) {
    if (value == null) return '0%';
    return '${value.toStringAsFixed(2)}%';
  }
}
