function jsMath_Font_Detector () {
  var h = document.getElementsByTagName("BODY")[0];

  var d = document.createElement("DIV");
  d.style.fontSize   = "72px";

  var s1 = document.createElement("SPAN");
  s1.style.fontFamily = "lskdjflskdj";
  s1.innerHTML        = "mmmmmmmmmml";
  d.appendChild(s1);

  var s2 = document.createElement("SPAN");
  s2.style.fontFamily = "jsMath-cmr10";
  s2.innerHTML        = "mmmmmmmmmml";
  d.appendChild(s2);

  h.appendChild(d);
  var diff1 = s1.offsetWidth - s2.offsetWidth;
  var diff2 = s1.offsetHeight - s2.offsetHeight;
  h.removeChild(d);

  if ((diff1!=0) || (diff2!=0)) return true;
  return false;
}
