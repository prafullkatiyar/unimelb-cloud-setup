import shapely
from shapely.geometry import Point, Polygon
import json

data_tweet = []
with open("final_result.json", 'r', encoding = "utf-8") as geo_tweets:
    data_tweet = json.load(geo_tweets)

def sentiment_count():
    result = []
    with open("Simplify_Melbourne_SA2.geojson", 'r') as geocode_file:
        data_geo = json.load(geocode_file)
        features = data_geo['features']
        #print(len(features))
        for doc in features:
            sentiment_dict = {}
            positve_count = 0
            negative_count = 0
            neutral_count = 0
            #print("doc",doc)
            main_16 = doc['properties']['SA2_MAIN16']
            #print("main_16",main_16)
            name_16 = doc['properties']['SA2_NAME16']
            #print("name_16",name_16)
            #print(doc['geometry']['coordinates'][0])
            polygon = Polygon(doc['geometry']['coordinates'][0])
            #print("zzzpolygon",polygon)
                   
            for item in data_tweet['rows']:
                try:
                    main_16_tweet = item['value']['properties']['SA2_MAIN16']
                    lng = item['value']['geometry']['coordinates'][0]
                    lat = item['value']['geometry']['coordinates'][1]
                    location = Point(lng, lat)
                                
                    if polygon.contains(location): #inside this area
                        print("inside this area")
                        sentiment = item['value']['properties']['sentiment']
                        if sentiment == "negative":
                            negative_count += 1
                            print("negative_count",negative_count)
                        elif sentiment == "neutral":
                            neutral_count += 1
                            print("neutral_count",neutral_count)
                        else:
                            positve_count += 1 
                            print("positve_count",positve_count)

                except ValueError:
                    continue
            print("zzz",positve_count,negative_count, neutral_count )
            sentiment_dict['pos'] = positve_count
            sentiment_dict['neg'] = negative_count
            sentiment_dict['neu'] = neutral_count
            sentiment_dict['pos_rate'] = float(sentiment_dict['pos'])/max((sentiment_dict['pos']+sentiment_dict['neg']+sentiment_dict['neu']),1)
            sentiment_dict['neg_rate'] = float(sentiment_dict['neg'])/max((sentiment_dict['pos']+sentiment_dict['neg']+sentiment_dict['neu']),1)
            sentiment_dict['neu_rate'] = float(sentiment_dict['neu'])/max((sentiment_dict['pos']+sentiment_dict['neg']+sentiment_dict['neu']),1)

            doc['properties']['analysis'] = sentiment_dict

        result = data_geo

    with open("tweets_geojson.geojson",'a',encoding = "utf-8" ) as new_file:
        print("writing into the geojson file.")
        #print("writing result")
        data = json.dump(result, new_file)
        #print("writing in new_file", tweet)



if __name__ == "__main__":
    sentiment_count()
















                                                                        

