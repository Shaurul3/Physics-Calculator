function formulavitezei() {
    var str = document.getElementById("distantaparcursa").value;
    var str1 = document.getElementById("timpcorp").value;
    var str2 = document.getElementById("vitezacorp").value;

    if (str == null || str == "") {
        str = str1 * str2;
        $("#rezultat").text("Distanța este: " + str +  " m");
    } else if (str1 == null || str1 == "") {
        str1 = str / str2;
        $("#rezultat").text("Timpul este: " + str1 + " s");
    } else if (str2 == null || str2 == "") {
        str2 = str / str1;
        $("#rezultat").text("Viteza este:" + str2 + " m/s");
    } 
}

function formuladensitatii() {
    var str3 = document.getElementById("densitateacorpului").value;
    var str4 = document.getElementById("masacorp").value;
    var str5 = document.getElementById("volumcorp").value;


    if (str3 == null || str3 == "") {
        str3 = str4 / str5;
        $("#rezultat1").text("Densitatea este: " + str3 + " Kg/(m^3)");
    } else if (str4 == null || str4 == "") {
        str4 = str3 * str5;
        $("#rezultat1").text("Masa este: " + str4 + " Kg");
    } else if (str5 == null || str5 == "") {
        str5 = str4 / str3;
        $("#rezultat1").text("Volumul este: " + str5 + " m^3");
    } 
}

function legeagreutatii() {
    var str6 = document.getElementById("greutatateacorpului").value;
    var str26 = document.getElementById("masaG").value;
    var str7 = document.getElementById("accgravitationala").value;

    if (str6 == null || str6 == "") {
        str6 = str26 * str7;
        $("#rezultat2").text("Greutatea corpului este: " + str6 + " N");
    } else if (str4 == null || str4 == "") {
        str26 = str6 / str7;
        $("#rezultat2").text("Masa este: " + str26 + " Kg");
    } else if (str7 == null || str7 == "") {
        str7 = str6 / str26;
        $("#rezultat2").text("Accelerația gravitațională este: " + str7 + " m/(s^2)");
    }
}

function legeaff() {
    var str8 = document.getElementById("normalaF").value;
    var str9 = document.getElementById("ffcorp").value;
    var str10 = document.getElementById("cfcorp").value;

    if (str9 == null || str9 == "") {
        str9 = str8 * str10;
        $("#rezultat3").text("Forța de frecare este: " + str9 + " N");
    } else if (str8 == null || str8 == "") {
        str8 = str9 / str10;
        $("#rezultat3").text("Normala este: " + str8 + " N");
    } else if (str10 == null || str10 == "") {
        str10 = str9 / str8;
        $("#rezultat3").text("Coeficientul de frecare este: " + str10);
    }
}

function legeafe() {
    var str11 = document.getElementById("Fe").value;
    var str12 = document.getElementById("k").value;
    var str13 = document.getElementById("deltal").value;

    if (str11 == null || str11 == "") {
        str11 = str12 * str13;
        $("#rezultat4").text("Forța elastică este: " + str11 + " N");
    } else if (str12 == null || str12 == "") {
        str12 = str11 / str13;
        $("#rezultat4").text("Constanta elastică este: " + str12 + " N/m");
    } else if (str13 == null || str13 == "") {
        str13 = str11 / str12;
        $("#rezultat4").text("Alungirea barei este: " + str13 + " m");
    }
}

function formulaintensitatii() {
    var str14 = document.getElementById("intensitate").value;
    var str15 = document.getElementById("Q").value;
    var str16 = document.getElementById("deltat").value;

    if (str14 == null || str14 == "") {
        str14 = str15 / str16;
        $("#rezultat5").text("Intensitatea este: " + str14 + " A");
    } else if (str15 == null || str15 == "") {
        str15 = str14 * str16;
        $("rezultat5").text("Sarcina electrică este: " + str15 + " C");
    } else if (str16 == null || str16 == "") {
        str16 = str15 / str14;
        $("#rezultat5").text("Intervalul de timp este: " + str16 + " s");
    }
}

function formulaQ() {
    var str27 = document.getElementById("Q1").value;
    var str17 = document.getElementById("nrelectroni").value;
    var e = 1.6 * (10 ** (-19));

    if (str27 == null || str27 == "") {
        str27 = str17 * e;
        $("#rezultat6").text("Sarcina electrică este: " + str27 + " C");
    } else if (str17 == null || str17 == "") {
        str17 = str27 / e;
        $("#rezultat6").text("Numarul de electroni este: " + str17);
    }
}

function LegealuiOhmportiune() {
    var str28 = document.getElementById("intensitateOhm").value;
    var str18 = document.getElementById("U").value;
    var str19 = document.getElementById("R").value;

    if (str28 == null || str28 == "") {
        str28 = str18 / str19;
        $("#rezultat7").text("Intensitatea este: " + str28 + " A");
    } else if (str18 == null || str18 == "") {
        str18 = str28 * str19;
        $("#rezultat7").text("Tensiunea electrică este: " + str18 + " V");
    } else if (str19 == null || str19 == "") {
        str19 = str18 / str28;
        $("#rezultat7").text("Rezistența electrică este: " + str19 + "ohmi");
    }
}

function Intensitateadescurt() {
    var str20 = document.getElementById("Intensitateasc").value;
    var str21 = document.getElementById("E").value;
    var str22 = document.getElementById("r").value;

    if (str20 == null || str20 == "") {
        str20 = str21 / str22;
        $("#rezultat8").text("Intensitatea de scurtcircuit este: " + str20 + " A");
    } else if (str21 == null || str21 == "") {
        str21 = str20 * str22;
        $("#rezultat8").text("Tensiunea electromotoare este: " + str21 + " V");
    } else if (str22 == null || str22 == "") {
        str22 = str21 / str20;
        $("#rezultat8").text("Rezistența internă este: " + str22 + "ohmi");
    }
}

function Puterea() {
    var str23 = document.getElementById("P").value;
    var str29 = document.getElementById("Putere-U").value;
    var str30 = document.getElementById("Putere-intensitate").value;

    if (str23 == null || str23 == "") {
        str23 = str30 * str29;
        $("#rezultat9").text("Puterea electrică este: " + str23 + " W");
    } else if (str29 == null || str29 == "") {
        str29 = str23 / str30;
        $("#rezultat9 ").text("Tensiunea electrică este: " + str29 + " V");
    } else if (str30 == null || str30 == "") {
        str30 = str23 / str28;
        $("#rezultat9").text("Intensitatea este: " + str30 + " A");
    }
}

function PutereaTotala() {
    var str24 = document.getElementById("Pt").value;
    var str31 = document.getElementById("Puterea totala-E").value;
    var str32 = document.getElementById("Puterea totala-intensitate").value;

    if (str24 == null || str24 == "") {
        str24 = str31 * str32;
        $("#rezultat10").text("Puterea totală este: " + str24 + " W");
    } else if (str31 == null || str31 == "") {
        str31 = str24 / str32;
        $("#rezultat10").text("Tensiunea electromotoare este: " + str31 + " V");
    } else if (str32 == null || str32 == "") {
        str32 = str24 / str31;
        $("#rezultat10").text("Intensitatea este: " + str32 + " A");
    }
}

function Randament() {
    var str25 = document.getElementById("randament").value;
    var str33 = document.getElementById("randament-E").value;
    var str34 = document.getElementById("randament-U").value;

    if (str25 == null || str25 == "") {
        str25 = str34 / str33;
        $("#rezultat11").text("Randamentul este: " + str25);
    } else if (str34 == null || str34 == "") {
        str34 = str25 * str33;
        $("#rezultat11").text("Tensiunea electrică este: " + str34 + " V");
    } else if (str33 == null || str33 == "") {
        str33 = str34 / str25;
        $("#rezultat11").text("Tensiunea electromotoare este: " + str33 + " V");
    }
}

function MECANICA() {
    formulavitezei();
    formuladensitatii();
    legeagreutatii();
    legeaff();
    legeafe();
}

function ELECTRICITATE() {
    formulaintensitatii();
    formulaQ();
    LegealuiOhmportiune();
    Intensitateadescurt();
    Puterea();
    PutereaTotala();
    Randament();
}
