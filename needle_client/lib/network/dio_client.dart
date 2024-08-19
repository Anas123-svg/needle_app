import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart' show kDebugMode;
import 'package:get/get.dart' hide Response, Trans;

import 'package:needle_project/network/dio_exception.dart';
import 'package:needle_project/network/endpoints.dart';

import 'interceptors/logger_interceptor.dart';

class DioClient {
  static DioClient? _instance;

  DioClient._();

  static DioClient instance() {
    _instance ??= DioClient._();
    return _instance!;
  }

  void initialize() {
    _dio = Dio(
      BaseOptions(
        connectTimeout: const Duration(seconds: Endpoints.connectionTimeout),
        receiveTimeout: const Duration(seconds: Endpoints.receiveTimeout),
        responseType: ResponseType.json,
      ),
    )..interceptors.addAll([
        LoggerInterceptor(),
      ]);
  }

  late final Dio _dio;

  Dio get dio => _dio;

  Future<Response> get(
      {Map<String, dynamic>? data,
      bool token = false,
      required String endPoint,
      String baseUrl = Endpoints.baseURL}) async {
    try {
      final url = baseUrl + endPoint;
      var response = await _dio.get(url);
      return response;
    } on DioException catch (err) {
      final errorMessage = DioDynamicException.fromDioError(err).toString();
      throw errorMessage;
    } catch (e) {
      if (kDebugMode) print(e);
      throw e.toString();
    }
  }

  Future<Response> post(
      {var data,
      bool token = false,
      required String endPoint,
      String baseUrl = Endpoints.baseURL}) async {
    try {
      final url = baseUrl + endPoint;

      var response = await _dio.post(url, data: data);

      return response;
    } on DioException catch (err) {
      String errorMessage = '';
      if (err.response != null) {
        //errorMessage = err.response!.data['message'];
        print(errorMessage);
      } else {
        errorMessage = DioDynamicException.fromDioError(err).toString();
      }
      throw errorMessage;
    } catch (e) {
      if (kDebugMode) print(e);
      throw e.toString();
    }
  }

  Future<Response> put(
      {Map<String, dynamic>? data,
      required String endPoint,
      String baseUrl = Endpoints.baseURL}) async {
    try {
      final url = baseUrl + endPoint;
      final response = await _dio.put(url, data: data);
      return response;
    } on DioException catch (err) {
      String errorMessage = '';
      if (err.response != null) {
        errorMessage = err.response!.data['message'];
      } else {
        errorMessage = DioDynamicException.fromDioError(err).toString();
      }
      throw errorMessage;
    } catch (e) {
      if (kDebugMode) print(e);
      throw e.toString();
    }
  }
}
