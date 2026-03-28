import 'dart:convert';
import 'package:http/http.dart' as http;
import '../config/app_config.dart';

class ApiException implements Exception {
  final int statusCode;
  final String message;
  final Map<String, dynamic>? errors;

  ApiException(this.statusCode, this.message, {this.errors});

  @override
  String toString() => message;

  String get localizedMessage {
    switch (statusCode) {
      case 401:
        return 'เซสชันหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง';
      case 403:
        return 'คุณไม่มีสิทธิ์เข้าถึงข้อมูลนี้';
      case 404:
        return 'ไม่พบข้อมูลที่ร้องขอ';
      case 422:
        return 'ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง';
      case 429:
        return 'คำขอมากเกินไป กรุณารอสักครู่';
      case 500:
        return 'เกิดข้อผิดพลาดจากเซิร์ฟเวอร์';
      default:
        return message.isNotEmpty ? message : 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง';
    }
  }
}

class ApiService {
  static const String baseUrl = AppConfig.apiBaseUrl;
  String? _token;
  String? _tenantId;

  static final ApiService _instance = ApiService._internal();
  factory ApiService() => _instance;
  ApiService._internal();

  void setToken(String? token) {
    _token = token;
  }

  void setTenantId(String? tenantId) {
    _tenantId = tenantId;
  }

  Map<String, String> get _headers {
    final headers = <String, String>{
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    };
    if (_token != null) {
      headers['Authorization'] = 'Bearer $_token';
    }
    if (_tenantId != null) {
      headers['X-Tenant-ID'] = _tenantId!;
    }
    return headers;
  }

  Future<Map<String, dynamic>> get(String endpoint) async {
    try {
      final response = await http
          .get(
            Uri.parse('$baseUrl$endpoint'),
            headers: _headers,
          )
          .timeout(const Duration(seconds: 30));
      return _handleResponse(response);
    } on http.ClientException {
      throw ApiException(0, 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException(0, 'เกิดข้อผิดพลาดในการเชื่อมต่อ');
    }
  }

  Future<Map<String, dynamic>> post(
    String endpoint,
    Map<String, dynamic> body,
  ) async {
    try {
      final response = await http
          .post(
            Uri.parse('$baseUrl$endpoint'),
            headers: _headers,
            body: jsonEncode(body),
          )
          .timeout(const Duration(seconds: 30));
      return _handleResponse(response);
    } on http.ClientException {
      throw ApiException(0, 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException(0, 'เกิดข้อผิดพลาดในการเชื่อมต่อ');
    }
  }

  Future<Map<String, dynamic>> put(
    String endpoint,
    Map<String, dynamic> body,
  ) async {
    try {
      final response = await http
          .put(
            Uri.parse('$baseUrl$endpoint'),
            headers: _headers,
            body: jsonEncode(body),
          )
          .timeout(const Duration(seconds: 30));
      return _handleResponse(response);
    } on http.ClientException {
      throw ApiException(0, 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException(0, 'เกิดข้อผิดพลาดในการเชื่อมต่อ');
    }
  }

  Future<Map<String, dynamic>> delete(String endpoint) async {
    try {
      final response = await http
          .delete(
            Uri.parse('$baseUrl$endpoint'),
            headers: _headers,
          )
          .timeout(const Duration(seconds: 30));
      return _handleResponse(response);
    } on http.ClientException {
      throw ApiException(0, 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
    } catch (e) {
      if (e is ApiException) rethrow;
      throw ApiException(0, 'เกิดข้อผิดพลาดในการเชื่อมต่อ');
    }
  }

  Map<String, dynamic> _handleResponse(http.Response response) {
    final body = response.body.isNotEmpty
        ? jsonDecode(response.body) as Map<String, dynamic>
        : <String, dynamic>{};

    if (response.statusCode >= 200 && response.statusCode < 300) {
      return body;
    }

    final message = body['message'] as String? ?? '';
    final errors = body['errors'] as Map<String, dynamic>?;
    throw ApiException(response.statusCode, message, errors: errors);
  }
}
