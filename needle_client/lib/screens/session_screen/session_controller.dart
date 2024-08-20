import 'dart:io';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:image_picker/image_picker.dart';

class SessionController extends GetxController {
  File? _image;
  final ImagePicker picker = ImagePicker();
  Future<void> pickImage(ImageSource source) async {
    final pickedFile = await picker.pickImage(source: source);

    if (pickedFile != null) {
      _image = File(pickedFile.path);
    }
  }

  final phonenumber = TextEditingController().obs;
  final email = TextEditingController().obs;

  var selectedValue = Rx<String?>(null);
  List<String> options = ['Option 1', 'Option 2', 'Option 3'];

  void ChangeSelectedValue(String? value) {
    selectedValue.value = value!;
    print('${selectedValue.value}');
  }
}
