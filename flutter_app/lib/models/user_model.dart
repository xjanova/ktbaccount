class UserModel {
  final int id;
  final String name;
  final String email;
  final String? phone;
  final String? memberCode;
  final String? avatar;
  final bool isSuperAdmin;
  final List<TenantRole> tenants;

  UserModel({
    required this.id,
    required this.name,
    required this.email,
    this.phone,
    this.memberCode,
    this.avatar,
    this.isSuperAdmin = false,
    this.tenants = const [],
  });

  factory UserModel.fromJson(Map<String, dynamic> json) {
    final tenantsList = <TenantRole>[];
    if (json['tenants'] != null) {
      for (final t in json['tenants'] as List<dynamic>) {
        tenantsList.add(TenantRole.fromJson(t as Map<String, dynamic>));
      }
    }

    return UserModel(
      id: json['id'] as int? ?? 0,
      name: json['name'] as String? ?? '',
      email: json['email'] as String? ?? '',
      phone: json['phone'] as String?,
      memberCode: json['member_code'] as String?,
      avatar: json['avatar'] as String?,
      isSuperAdmin: json['is_super_admin'] as bool? ?? false,
      tenants: tenantsList,
    );
  }

  Map<String, dynamic> toJson() => {
        'id': id,
        'name': name,
        'email': email,
        'phone': phone,
        'member_code': memberCode,
        'avatar': avatar,
        'is_super_admin': isSuperAdmin,
      };

  /// Get current tenant name (first tenant or empty)
  String get currentTenantName =>
      tenants.isNotEmpty ? tenants.first.tenantName : '';

  /// Get current role label in Thai
  String get currentRoleLabel {
    if (tenants.isEmpty) return 'สมาชิก';
    return tenants.first.roleLabel;
  }
}

class TenantRole {
  final int tenantId;
  final String tenantName;
  final String role;
  final bool isPrimary;

  TenantRole({
    required this.tenantId,
    required this.tenantName,
    required this.role,
    this.isPrimary = false,
  });

  factory TenantRole.fromJson(Map<String, dynamic> json) {
    // Handle nested pivot/role structures
    final pivot = json['pivot'] as Map<String, dynamic>?;
    return TenantRole(
      tenantId: json['id'] as int? ?? pivot?['tenant_id'] as int? ?? 0,
      tenantName: json['name'] as String? ?? '',
      role: pivot?['role'] as String? ?? json['role'] as String? ?? 'member',
      isPrimary: pivot?['is_primary'] as bool? ??
          json['is_primary'] as bool? ??
          false,
    );
  }

  String get roleLabel {
    switch (role) {
      case 'admin':
        return 'ผู้ดูแลระบบ';
      case 'committee':
        return 'คณะกรรมการ';
      case 'treasurer':
        return 'เหรัญญิก';
      case 'secretary':
        return 'เลขานุการ';
      case 'chairman':
        return 'ประธาน';
      case 'member':
      default:
        return 'สมาชิก';
    }
  }
}
