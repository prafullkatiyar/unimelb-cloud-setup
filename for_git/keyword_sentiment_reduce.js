function(keys, values) {
  var coordinates = [];
  values.forEach(function(v) {
    coordinates = coordinates.concat(v);
  });
  return coordinates;
}
