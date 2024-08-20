import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/session_screen/session_controller.dart';

import '../screens/session_screen/session_controller.dart';

class global_dropdown extends StatelessWidget {
  final String? selectedValue;
  final List<dynamic>? option;
  final Function(String?) onChanged;
  final String? title;
  global_dropdown({
    super.key,
    required this.sessionController,
    this.title,
    required this.onChanged,
    this.selectedValue,
    this.option,
  });

  final SessionController sessionController;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(top: 10),
      decoration: BoxDecoration(
          border: Border.all(), borderRadius: BorderRadius.circular(15)),
      child: DropdownButton<String>(
        isExpanded: true,
        hint: Padding(
          padding: const EdgeInsets.only(left: 8.0),
          child: Text(
            '$title',
            style: GoogleFonts.montserrat(fontWeight: FontWeight.bold),
          ),
        ),
        value: selectedValue,
        icon: const Icon(Icons.arrow_drop_down),
        iconSize: 24,
        elevation: 16,
        style: const TextStyle(color: Colors.black),
        underline: Container(
          color: Colors.transparent,
        ),
        onChanged: (String? newValue) {
          onChanged(newValue);
        },
        items: (sessionController.options ?? [])
            .map<DropdownMenuItem<String>>((String value) {
          return DropdownMenuItem<String>(
            value: value,
            child: Text(value),
          );
        }).toList(),
      ),
    );
  }
}
