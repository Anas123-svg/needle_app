import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:get/get_core/get_core.dart';
import 'package:get/get_instance/get_instance.dart';
import 'package:get/get_state_manager/src/rx_flutter/rx_obx_widget.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:needle_project/screens/portfolio_screen/portfolio_controller.dart';
import 'package:needle_project/utils/colors.dart';
import 'package:needle_project/widgets/global_button.dart';

class portfolioScreen extends StatefulWidget {
  const portfolioScreen({super.key});

  @override
  State<portfolioScreen> createState() => _portfolioScreenState();
}

class _portfolioScreenState extends State<portfolioScreen> {
  final PortfolioController portfolioController =
      Get.put(PortfolioController());
  @override
  Widget build(BuildContext context) {
    double h = MediaQuery.of(context).size.height;
    double w = MediaQuery.of(context).size.width;

    return Container(
      margin: EdgeInsets.all(30),
      width: double.infinity,
      child: Column(
        children: [
          global_button(
            callBackFunction: portfolioController.addNewImage,
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
                  'Add New Image',
                  style: GoogleFonts.montserrat(
                      fontWeight: FontWeight.w700,
                      fontSize: 13,
                      color: AppColors.whiteColor),
                )
              ],
            ),
          ),
          Expanded(
            child: Obx(() {
              return Container(
                  margin: EdgeInsets.only(top: 40),
                  height: 500,
                  child: AlignedGridView.count(
                    scrollDirection: Axis.vertical,
                    crossAxisCount: 3, // 3 photos per row
                    itemCount: portfolioController.profilePics.length,
                    itemBuilder: (BuildContext context, int index) {
                      return Image.asset(
                          fit: BoxFit.cover,
                          portfolioController.profilePics[index]);
                    },
                    mainAxisSpacing: 40.0,
                    crossAxisSpacing: 40.0,
                  ));
            }),
          ),
        ],
      ),
    );
  }
}
