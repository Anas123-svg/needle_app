import 'package:dropdown_button2/dropdown_button2.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:get/get_core/get_core.dart';
import 'package:get/get_instance/get_instance.dart';
import 'package:get/get_rx/src/rx_typedefs/rx_typedefs.dart';
import 'package:get/get_state_manager/get_state_manager.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:image_picker/image_picker.dart';
import 'package:needle_project/screens/session_screen/session_controller.dart';
import 'package:needle_project/utils/Colors.dart';
import 'package:needle_project/widgets/global_button.dart';
import 'package:needle_project/widgets/global_dropdown.dart';
import 'package:needle_project/widgets/global_textField.dart';
import 'package:needle_project/widgets/session_screen_widgets/text_with_dropdown.dart';
import 'package:needle_project/widgets/session_screen_widgets/text_with_textfield.dart';

class SessionScreen extends StatefulWidget {
  const SessionScreen({super.key});

  @override
  State<SessionScreen> createState() => _SessionScreenState();
}

class _SessionScreenState extends State<SessionScreen> {
  final SessionController sessionController = Get.put(SessionController());
  @override
  Widget build(BuildContext context) {
    double w = MediaQuery.of(context).size.width;
    double h = MediaQuery.of(context).size.height;

    return Container(
        padding: EdgeInsets.all(15),
        margin: EdgeInsets.symmetric(vertical: 30, horizontal: 20),
        width: double.infinity,
        decoration: BoxDecoration(
            border: Border.all(width: 2, color: AppColors.mintyGreen),
            borderRadius: BorderRadius.circular(20)),
        height: 800,
        child: SingleChildScrollView(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              text_with_dropdown(
                sessionController: sessionController,
                gb: global_dropdown(
                  selectedValue: sessionController.selectedValue.value,
                  option: sessionController.options!,
                  onChanged: sessionController.ChangeSelectedValue,
                  sessionController: sessionController,
                  title: 'Fetch from Google calender',
                ),
                txt: 'Client name',
              ),
              text_with_textfield(
                sessionController: sessionController,
                txt: 'Phone Number',
                gb: global_textfield(
                  controller: sessionController.phonenumber.value,
                  textfieldDecoration: InputDecoration(
                      enabledBorder: OutlineInputBorder(
                        borderSide: BorderSide(color: Colors.black),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      focusedBorder: OutlineInputBorder(
                        borderSide: BorderSide(color: Colors.black),
                        borderRadius: BorderRadius.circular(20),
                      )),
                ),
              ),
              text_with_textfield(
                sessionController: sessionController,
                txt: 'Email',
                gb: global_textfield(
                  controller: sessionController.email.value,
                  textfieldDecoration: InputDecoration(
                      enabledBorder: OutlineInputBorder(
                        borderSide: BorderSide(color: Colors.black),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      focusedBorder: OutlineInputBorder(
                        borderSide: BorderSide(color: Colors.black),
                        borderRadius: BorderRadius.circular(20),
                      )),
                ),
              ),
              text_with_dropdown(
                sessionController: sessionController,
                gb: global_dropdown(
                  selectedValue: sessionController.selectedValue.value,
                  option: sessionController.options!,
                  onChanged: sessionController.ChangeSelectedValue,
                  sessionController: sessionController,
                  title: 'Tattoo  150\$/h+tx',
                ),
                txt: 'Session Type',
              ),
              text_with_dropdown(
                sessionController: sessionController,
                gb: global_dropdown(
                  selectedValue: sessionController.selectedValue.value,
                  option: sessionController.options!,
                  onChanged: sessionController.ChangeSelectedValue,
                  sessionController: sessionController,
                  title: '2 hours',
                ),
                txt: 'Break time',
              ),
              SizedBox(
                height: 5,
              ),
              Container(
                decoration: BoxDecoration(border: Border.all()),
                width: double.infinity,
                height: h * 0.25,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Container(
                        padding: EdgeInsets.all(10),
                        child: Text(
                          'A knight  half sleeve with red eyes.Background with arrows.See attached files for references Available every monday',
                          style: GoogleFonts.montserrat(
                              fontWeight: FontWeight.w700,
                              fontSize: 12,
                              height: 2),
                        )),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                        Image.asset('assets/images/Rectangle415.png'),
                        Image.asset('assets/images/Rectangle415.png'),
                        Image.asset('assets/images/Rectangle415.png')
                      ],
                    )
                  ],
                ),
              ),
              SizedBox(
                height: 10,
              ),
              Row(mainAxisAlignment: MainAxisAlignment.spaceBetween, children: [
                global_button(
                  anyWidget: Center(
                    child: Image.asset(
                      'assets/icons/attachment.png',
                    ),
                  ),
                  w: w * 0.2,
                  h: h * 0.07,
                  containerDecoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      color: AppColors.mintyGreen),
                ),
                global_button(
                  anyWidget: Center(
                    child: Text(
                      'save',
                      style:
                          GoogleFonts.montserrat(fontWeight: FontWeight.w700),
                    ),
                  ),
                  w: w * 0.2,
                  h: h * 0.07,
                  containerDecoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      color: AppColors.mintyGreen),
                )
              ])
            ],
          ),
        ));
  }
}
