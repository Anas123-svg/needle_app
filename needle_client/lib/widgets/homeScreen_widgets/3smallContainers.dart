import 'package:flutter/material.dart';

class Small3Container extends StatelessWidget {
  final Color containerColor;
  final dynamic data;
  const Small3Container({
    super.key,
    required this.h,
    required this.w,
    required this.containerColor,
    this.data,
  });

  final double h;
  final double w;

  @override
  Widget build(BuildContext context) {
    return Container(
      height: h * 0.08,
      width: w * 0.17,
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(5), color: containerColor),
      child: Center(
        child: data,
      ),
    );
  }
}
