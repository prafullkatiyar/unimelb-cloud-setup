function (doc) {
  var keywords = ["government", "liberal", "labour", "greens"]
  var words = doc.text.split(/[\s\.,]+/)
  for (var i in words) {
    if (includes(keywords, words[i].toLowerCase())) {
      emit(doc.properties.sentiment,[doc.coordinates.coordinates]);
      emit("total",[doc.coordinates.coordinates]);
      break;
    }
  }
  function includes(arr, obj) {
    return (arr.indexOf(obj) != -1);
  }
}
