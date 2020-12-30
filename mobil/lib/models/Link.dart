class Link {
  final String domain;
  final String name;
 // final List phones;
 // final List emails;

  Link({this.domain, this.name});

  factory Link.fromJson(Map<String, dynamic> json) {
    return Link(
      domain: json['Domain'],
      name: json['Isim'],
     // phones: json['phones'],
     // emails: json['emails']
    );
  }
  @override 
  String toString(){
    return this.domain + ":" + this.name;
  }
  String getDomain(){
    return this.domain;
  }
  String getName(){
    return this.name;
  }
}