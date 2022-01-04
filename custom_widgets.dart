import 'package:flutter/services.dart';
import 'package:get/get.dart';
import 'package:flutter/material.dart';
import 'package:mobile_info/functions/common_functions.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:avatar_glow/avatar_glow.dart';
import 'package:mobile_info/screens/home_screen.dart';

Color primary = Color(0xfffbbb00);
Color secondary = Color(0xff272f32);
Color inputColor = const Color(0xffeeeeee);
String noInternet = "";
String tryAgain = "";

cmLoadingScreen(dynamic context, {double top = 0.4}) {
  return Container(
    color: secondary,
    width: Get.width,
    height: Get.height,
    child: Stack(children: [
      Positioned(
        child: cmLoading(size: 100),
        top: Get.height * top,
        left: 0,
        right: 0,
      )
    ]),
  );
}

cmLoading({double size = 50}) {
  return SpinKitWave(
    color: primary,
    size: size,
  );
}

noConnectionLabel() {
  if (language == "ar") {
    noInternet = "لا يوجد اتصال بالانترنت";
    tryAgain = "حاول مجددا";
  } else {
    noInternet = "No network connection";
    tryAgain = "Try again";
  }
}

cmNoConnection(VoidCallback callFunction) {
  noConnectionLabel();
  return Container(
    width: Get.width,
    color: Colors.white,
    child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          const Icon(
            Icons.wifi_off,
            size: 100,
          ),
          const SizedBox(
            height: 10,
          ),
          Text(noInternet),
          const SizedBox(
            height: 10,
          ),
          cmButton(
            text: tryAgain,
            icon: Icons.rotate_left_sharp,
            callFunction: callFunction,
          )
        ]),
  );
}

cmShadowBox() {
  return BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(10),
      boxShadow: [
        BoxShadow(
          color: Colors.grey.withOpacity(0.5),
          spreadRadius: 5,
          blurRadius: 7,
          offset: const Offset(0, 3), // changes position of shadow
        )
      ]);
}

cmAppBar(
    {String title = "",
    bool showDrawer = false,
    GlobalKey<ScaffoldState>? scaffoldKey}) {
  return AppBar(
    iconTheme: IconThemeData(
      color: secondary,
    ),
    backgroundColor: primary,
    shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(
      bottom: Radius.circular(0),
    )),
    title: Text(
      title,
      style: TextStyle(color: secondary),
    ),
    elevation: 0,
    leading: showDrawer
        ? Container(
            color: primary,
            padding: EdgeInsets.all(10),
            child: InkWell(
                onTap: () {
                  scaffoldKey!.currentState!.openDrawer();
                },
                child: Container(
                  decoration: BoxDecoration(
                      color: secondary, borderRadius: BorderRadius.circular(8)),
                  child: Icon(
                    Icons.sort_outlined,
                    color: primary,
                  ),
                )),
          )
        : null,
    actions: [],
  );
}

cmDrawer(context) {
  return Drawer(
    child: SafeArea(
      child: Container(
        color: secondary,
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            Image.asset(
              "assets/images/logo_drawer.png",
              width: Get.width,
            ),
            ListTile(
              leading: Icon(
                Icons.people,
                color: primary,
              ),
              title: Text(
                'About Us',
                style: TextStyle(color: primary),
              ),
              onTap: () {
                // Update the state of the app.
                // ...
              },
            ),
            ListTile(
              leading: Icon(
                Icons.email,
                color: primary,
              ),
              title: Text(
                'Contact Us',
                style: TextStyle(color: primary),
              ),
              onTap: () {
                // Update the state of the app.
                // ...
              },
            ),
            ListTile(
              leading: Icon(
                Icons.mobile_friendly,
                color: primary,
              ),
              title: Text(
                'Mobile',
                style: TextStyle(color: primary),
              ),
              onTap: () {
               Get.to(()=>Home(type: "view",));
              },
            ),
            ListTile(
              leading: Icon(
                Icons.delete_sweep_sharp,
                color: primary,
              ),
              title: Text(
                'Reset',
                style: TextStyle(color: primary),
              ),
              onTap: () {
               deleteService();
              },
            ),
          ],
        ),
      ),
    ),
  );
}

cmBody({
  required Widget child,
  bool padding = false,
}) {
  return Container(
    padding: padding
        ? const EdgeInsets.fromLTRB(10, 20, 10, 10)
        : const EdgeInsets.all(0),
    width: Get.width,
    height: Get.height,
    decoration: BoxDecoration(
        color: secondary,
        borderRadius: BorderRadius.only(
            topLeft: Radius.circular(0), topRight: Radius.circular(0))),
    child: child,
  );
}

cmImage(
    {String url = "",
    double width = 50.0,
    double? height = 50.0,
    BoxFit fit = BoxFit.contain}) {
  return CachedNetworkImage(
      fit: BoxFit.fill,
      width: width,
      height: height,
      placeholder: (context, url) =>
          Opacity(opacity: 0.5, child: Image.asset("assets/images/logo.png")),
      imageUrl: url);
}

cmPageTitle({String title = "", String hint = ""}) {
  return Container(
    padding: const EdgeInsets.all(20),
    width: Get.width,
    decoration: BoxDecoration(
        color: primary,
        borderRadius: const BorderRadius.only(
            bottomLeft: Radius.circular(50), bottomRight: Radius.circular(0))),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FittedBox(
          child: Text(
            title,
            style: TextStyle(
                fontSize: 30, fontWeight: FontWeight.bold, color: secondary),
          ),
        ),
        SizedBox(
          height: 10,
        ),
        Text(
          hint,
          style: TextStyle(fontWeight: FontWeight.bold),
        )
      ],
    ),
  );
}

languageDirection({required Widget child}) {
  return Directionality(
    textDirection: language == "ar" ? TextDirection.rtl : TextDirection.ltr,
    child: child,
  );
}

cmAlert({
  required String title,
  String type = "success",
}) {
  Get.snackbar(title, "",
      maxWidth: Get.width * 0.95,
      padding: const EdgeInsets.fromLTRB(10, 20, 10, 0),
      colorText: Colors.white,
      snackPosition: SnackPosition.TOP,
      margin: const EdgeInsets.fromLTRB(10, 50, 10, 0),
      backgroundColor: type == "success"
          ? Colors.green
          : type == "failure"
              ? Colors.redAccent
              : Colors.orange,
      icon: type == "success"
          ? const Icon(Icons.check_circle, color: Colors.white)
          : type == "fail"
              ? const Icon(Icons.warning_amber_outlined, color: Colors.white)
              : const Icon(Icons.assignment_late_outlined,
                  color: Colors.white));
}

cmPositioned({
  required Widget child,
  double? start = 0,
  double? end = 0,
  double? top = 0,
  double? bottom = 0,
}) {
  return Positioned(
      top: top,
      bottom: bottom,
      left: language == "en" ? start : end,
      right: language == "ar" ? start : end,
      child: child);
}

cmInput({
  String label = "",
  String? error,
  TextEditingController? controller,
  IconData? icon,
  bool obscureText = false,
  dynamic filter,
  int minLines = 1,
  int maxLines = 1,
  dynamic keyboardType = TextInputType.text,
  bool enabled = true,
}) {
  return Center(
    child: Container(
      margin: const EdgeInsets.fromLTRB(0, 10, 0, 10),
      width: Get.width * 0.9,
      child: TextField(
        style: TextStyle(
          color: Colors.white,
        ),
        enabled: enabled,
        minLines: minLines,
        maxLines: maxLines,
        obscureText: obscureText,
        controller: controller,
        keyboardType: keyboardType,
        inputFormatters: [
          filter ?? FilteringTextInputFormatter.deny(RegExp('[]')),
        ],
        decoration: InputDecoration(
          labelStyle: TextStyle(color: Colors.white),
          prefixIcon: Icon(
            icon,
            color: Colors.white,
          ),
          //hintText: label,
          // fillColor: inputColor,
          // filled: true,
          labelText: label,
          errorText: error,
          errorMaxLines: 3,
          focusedErrorBorder: UnderlineInputBorder(
            borderSide: const BorderSide(color: Colors.red, width: 1.0),
            borderRadius: BorderRadius.circular(10.0),
          ),
          errorBorder: UnderlineInputBorder(
            borderSide: const BorderSide(color: Colors.red, width: 1.0),
            borderRadius: BorderRadius.circular(10.0),
          ),
          enabledBorder: UnderlineInputBorder(
            borderSide: BorderSide(color: Colors.white, width: 0.0),
            borderRadius: BorderRadius.circular(10.0),
          ),
          focusedBorder: UnderlineInputBorder(
            borderSide: BorderSide(color: primary, width: 1.0),
            borderRadius: BorderRadius.circular(10.0),
          ),
          disabledBorder: UnderlineInputBorder(
            borderSide: BorderSide(color: inputColor, width: 0.0),
            borderRadius: BorderRadius.circular(10.0),
          ),
        ),
      ),
    ),
  );
}

cmButton({
  String text = "",
  IconData? icon,
  VoidCallback? callFunction,
  double? width = null,
  double padding = 15,
  Color? buttonColor,
  Color textColor = Colors.white,
  double borderWidth = 0,
  double marginTopBottom = 10,
  String? assetsImagePath,
}) {
  if (width == null) {
    width = Get.width * 0.9;
  }
  if (buttonColor == null) {
    buttonColor = primary;
  }
  return Container(
    margin: EdgeInsets.fromLTRB(0, marginTopBottom, 0, marginTopBottom),
    width: width,
    child: ElevatedButton(
      onPressed: callFunction,
      child: Stack(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const SizedBox(width: 10),
              Text(
                text,
                style: TextStyle(color: textColor),
              ),
              const SizedBox(width: 10),
              Icon(
                icon,
                color: Colors.white,
              )
            ],
          ),
          assetsImagePath == null
              ? const SizedBox(width: 0)
              : cmPositioned(
                  start: 20,
                  end: null,
                  child: Image.asset(
                    assetsImagePath,
                    width: 20,
                  ),
                ),
        ],
      ),
      style: ElevatedButton.styleFrom(
        elevation: 0,
        primary: buttonColor,
        padding: EdgeInsets.all(padding),
        shape: RoundedRectangleBorder(
          side: BorderSide(
              width: borderWidth,
              color: borderWidth > 0 ? primary : Colors.transparent),
          borderRadius: BorderRadius.circular(10.0),
        ),
      ),
    ),
  );
}

cmTextError({String errorMessage = ""}) {
  return Transform.translate(
    offset: const Offset(0, -5),
    child: SizedBox(
      width: Get.width * 0.9,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Text(
            errorMessage,
            textAlign: TextAlign.start,
            style: const TextStyle(
              color: Colors.red,
              fontSize: 12,
            ),
          )
        ],
      ),
    ),
  );
}

cmRowInfo({String label = "label", String value = "value"}) {
  return Container(
    margin: EdgeInsets.fromLTRB(0, 5, 0, 5),
    padding: EdgeInsets.all(10),
    child: Table(
      children: [
        TableRow(children: [
          Container(
              padding: EdgeInsets.all(8),
              decoration: BoxDecoration(
                  color: primary, borderRadius: BorderRadius.circular(8)),
              child: Text(
                label,
                style: TextStyle(
                    color: secondary,
                    fontWeight: FontWeight.bold,
                    fontSize: 20),
              )),
          Container(
              padding: EdgeInsets.all(8),
              child: Text(
                value,
                style: TextStyle(
                    color: primary, fontWeight: FontWeight.bold, fontSize: 20),
              )),
        ])
      ],
    ),
  );
}

cmGlowIcon({String type = "active"}) {
  Color iconColor = Colors.greenAccent;
  IconData iconData = Icons.check;
  if (type == "activeYellow") {
    iconColor = Colors.deepOrangeAccent;
  } else if (type == "failure") {
    iconData = Icons.close;
    iconColor = Colors.redAccent;
  }else if(type == "processing"){
    iconData = Icons.settings;
    iconColor = primary;
  }
  return AvatarGlow(
    glowColor: iconColor,
    endRadius: 100.0,
    child: Container(
      width: 100,
      height: 100,
      decoration: BoxDecoration(
          color: iconColor, borderRadius: BorderRadius.circular(100)),
      child: Icon(
        iconData,
        color: Colors.white,
        size: 70,
      ),
    ),
  );
}


cmMobileInfo({String label="label",String value="value",IconData iconDta=Icons.check,double width=100}){
  return  Container(
    width: width,
    padding: EdgeInsets.all(8),
    decoration: BoxDecoration(
        color: secondary,
        border: Border.all(color: primary,width: 1),
        borderRadius: BorderRadius.circular(8)),
    child: Column(
      children: [
        Icon(iconDta,size: 70,color: primary,),
        Text(label,style: TextStyle(fontSize: 20,color: primary),),

        Container(
            margin:const EdgeInsets.fromLTRB(0, 3, 0, 3),
            child: FittedBox(child: Text(value,style: TextStyle(color: Colors.white,fontWeight: FontWeight.bold,fontSize: 20),))),
      ],
    ),
  );
}
