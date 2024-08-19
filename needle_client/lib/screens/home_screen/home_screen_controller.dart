import 'package:get/get.dart';
import 'dart:async';

class HomeScreenController extends GetxController {
  var _seconds = 0.obs;
  var _minutes = 0.obs;
  var _hours = 0.obs;

  late Timer _timer;

  @override
  void onInit() {
    super.onInit();
    _startTimer();
  }

  void _startTimer() {
    _timer = Timer.periodic(Duration(seconds: 1), (Timer timer) {
      _seconds.value++;
      if (_seconds.value == 60) {
        _seconds.value = 0;
        _minutes.value++;
        if (_minutes.value == 60) {
          _minutes.value = 0;
          _hours.value++;
        }
      }
    });
  }

  @override
  void onClose() {
    _timer.cancel();
    super.onClose();
  }

  String get formattedTime {
    return "${_hours.value.toString().padLeft(2, '0')}:${_minutes.value.toString().padLeft(2, '0')}:${_seconds.value.toString().padLeft(2, '0')}";
  }
}
