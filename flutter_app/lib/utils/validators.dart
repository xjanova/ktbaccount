class Validators {
  static String? email(String? value) {
    if (value == null || value.trim().isEmpty) {
      return 'กรุณากรอกอีเมล';
    }
    final emailRegex = RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$');
    if (!emailRegex.hasMatch(value.trim())) {
      return 'รูปแบบอีเมลไม่ถูกต้อง';
    }
    return null;
  }

  static String? password(String? value) {
    if (value == null || value.isEmpty) {
      return 'กรุณากรอกรหัสผ่าน';
    }
    if (value.length < 6) {
      return 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร';
    }
    return null;
  }

  static String? required(String? value, [String fieldName = 'ข้อมูล']) {
    if (value == null || value.trim().isEmpty) {
      return 'กรุณากรอก$fieldName';
    }
    return null;
  }

  static String? phone(String? value) {
    if (value == null || value.trim().isEmpty) {
      return 'กรุณากรอกเบอร์โทรศัพท์';
    }
    final phoneRegex = RegExp(r'^0[0-9]{8,9}$');
    if (!phoneRegex.hasMatch(value.trim())) {
      return 'รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง';
    }
    return null;
  }

  static String? amount(String? value) {
    if (value == null || value.trim().isEmpty) {
      return 'กรุณากรอกจำนวนเงิน';
    }
    final amount = double.tryParse(value.replaceAll(',', ''));
    if (amount == null || amount <= 0) {
      return 'จำนวนเงินไม่ถูกต้อง';
    }
    return null;
  }
}
