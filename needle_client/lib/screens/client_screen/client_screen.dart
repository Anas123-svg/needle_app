import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/client_screen/client_controller.dart';
import 'package:needle_project/utils/colors.dart';
import 'package:needle_project/widgets/global_button.dart';
import 'package:needle_project/widgets/global_textField.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tablecelltext.dart';
import 'package:needle_project/widgets/homeScreen_widgets/tableheadertext.dart';

class ClientScreen extends StatefulWidget {
  const ClientScreen({super.key});

  @override
  State<ClientScreen> createState() => _ClientScreenState();
}

class _ClientScreenState extends State<ClientScreen> {
  final ClientController clientController = Get.put(ClientController());
  @override
  Widget build(BuildContext context) {
    double h = MediaQuery.of(context).size.height;
    double w = MediaQuery.of(context).size.width;
    return Container(
      margin: EdgeInsets.all(30),
      child: SingleChildScrollView(
        child: Column(
          children: [
            global_button(
              callBackFunction: clientController.addNewClient,
              containerDecoration: BoxDecoration(
                borderRadius: BorderRadius.circular(20),
                gradient: LinearGradient(colors: [
                  AppColors.richGreen4,
                  AppColors.richGreen5,
                ]),
              ),
              h: h * 0.15,
              w: double.infinity,
              anyWidget: Column(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  Container(
                    height: h * 0.08,
                    child: Image.asset('assets/icons/plus_icon.png'),
                  ),
                  Text(
                    'Add New Client',
                    style: GoogleFonts.montserrat(
                        fontWeight: FontWeight.w700,
                        fontSize: 13,
                        color: AppColors.whiteColor),
                  )
                ],
              ),
            ),
            Container(
              margin: EdgeInsets.only(top: 20, bottom: 20),
              child: global_textfield(
                  controller: clientController.SearchClient,
                  textfieldDecoration: InputDecoration(
                      enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(20),
                          borderSide: BorderSide(color: AppColors.mediumGray)),
                      focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(20),
                          borderSide: BorderSide(color: AppColors.mediumGray)),
                      label: Text(
                        'Search for a client',
                        style: GoogleFonts.montserrat(
                            color: AppColors.lightGray,
                            fontSize: 20,
                            fontWeight: FontWeight.w500),
                      ))),
            ),
            Container(
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(20),
                  border: Border.all(width: 3, color: AppColors.mintyGreen)),
              padding: EdgeInsets.all(10),
              child: Table(
                columnWidths: {
                  0: FlexColumnWidth(0.5),
                  1: FlexColumnWidth(1.1),
                  2: FlexColumnWidth()
                },
                children: [
                  TableRow(children: [
                    TableCell(
                        child: TableHeaderText(
                      name: "Name",
                    )),
                    TableCell(
                        child: TableHeaderText(
                      name: "Email",
                    )),
                    TableCell(
                        child: TableHeaderText(
                      name: "Phone Number",
                    )),
                  ]),
                  // Data Row 1
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(
                        border: Border(
                            bottom: BorderSide(color: Color(0XFFC2523E)))),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                  TableRow(
                    decoration: BoxDecoration(),
                    children: [
                      TableCellText(
                        name: 'abc',
                      ),
                      TableCellText(
                        name: 'abc@gmail.com',
                      ),
                      TableCellText(
                        name: '000000',
                      )
                    ],
                  ),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}
