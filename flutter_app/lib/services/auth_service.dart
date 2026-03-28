import 'package:shared_preferences/shared_preferences.dart';
import 'api_service.dart';
import '../models/user_model.dart';

class AuthService {
  final ApiService _api = ApiService();

  static final AuthService _instance = AuthService._internal();
  factory AuthService() => _instance;
  AuthService._internal();

  UserModel? _currentUser;
  UserModel? get currentUser => _currentUser;

  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await _api.post('/auth/login', {
      'email': email,
      'password': password,
    });

    final token = response['token'] as String?;
    if (token != null) {
      await saveToken(token);
      _api.setToken(token);
    }

    // Parse user and tenant info
    if (response['user'] != null) {
      _currentUser = UserModel.fromJson(response['user']);
      await _saveTenantId(_currentUser!.tenants.isNotEmpty
          ? _currentUser!.tenants.first.tenantId.toString()
          : null);
    }

    return response;
  }

  Future<void> logout() async {
    try {
      await _api.post('/auth/logout', {});
    } catch (_) {
      // Ignore logout API errors
    }
    _currentUser = null;
    _api.setToken(null);
    _api.setTenantId(null);
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_token');
    await prefs.remove('tenant_id');
    await prefs.remove('remember_me');
  }

  Future<UserModel?> getUser() async {
    try {
      final response = await _api.get('/auth/user');
      if (response['user'] != null) {
        _currentUser = UserModel.fromJson(response['user']);
        return _currentUser;
      }
      // Some APIs return user data at root level
      _currentUser = UserModel.fromJson(response);
      return _currentUser;
    } catch (e) {
      return null;
    }
  }

  Future<bool> isLoggedIn() async {
    final token = await getToken();
    if (token == null) return false;
    _api.setToken(token);

    // Restore tenant ID
    final prefs = await SharedPreferences.getInstance();
    final tenantId = prefs.getString('tenant_id');
    if (tenantId != null) {
      _api.setTenantId(tenantId);
    }

    return true;
  }

  Future<void> saveToken(String token) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('auth_token', token);
  }

  Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('auth_token');
  }

  Future<void> switchTenant(String tenantId) async {
    _api.setTenantId(tenantId);
    await _saveTenantId(tenantId);
  }

  Future<void> _saveTenantId(String? tenantId) async {
    final prefs = await SharedPreferences.getInstance();
    if (tenantId != null) {
      await prefs.setString('tenant_id', tenantId);
      _api.setTenantId(tenantId);
    }
  }

  Future<bool> getRememberMe() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getBool('remember_me') ?? false;
  }

  Future<void> setRememberMe(bool value) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setBool('remember_me', value);
  }

  Future<String?> getSavedEmail() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('saved_email');
  }

  Future<void> saveEmail(String email) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('saved_email', email);
  }
}
