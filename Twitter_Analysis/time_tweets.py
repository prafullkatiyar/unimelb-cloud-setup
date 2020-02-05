import json
import time
import datetime

data_tweets = [] #storing all the dates
with open("final_result.json", 'r+', encoding = "utf-8") as f:
    data_tweets = json.load(f)


location_dict = {} #stroring all geocodes of Mel
with open("Simplify_Melbourne_SA2.geojson",'r', encoding = "utf-8") as mel_geojson:
    docs = json.load(mel_geojson)
    features = docs['features']
    for doc in features:
        #print("doc",doc)
        main_16 = doc['properties']['SA2_MAIN16']
        #print("main_16",main_16)
        name_16 = doc['properties']['SA2_NAME16']
        location_dict[main_16] = name_16

def during_period(time,start_time,end_time):
    s1 = start_time
    s2 =  end_time
    now = time
    FMT = '%H:%M:%S'
    if datetime.datetime.strptime(now, FMT) >= datetime.datetime.strptime(start_time, FMT) and datetime.datetime.strptime(now, FMT) <= datetime.datetime.strptime(end_time, FMT):
        return True
    else:
        return False


def period_counter(data_tweets):
    json_object = {}
    json_list = []
    loc_dict = {}
    for k,v in location_dict.items():
        tweets_num = 0
        temp = {}
        for item in data_tweets['rows']:
            main_16 = item['value']['properties']['SA2_MAIN16']
            if k == main_16:
                try:
                    crteated_at  = item['value']['properties']['created_at']
                    ts = time.strftime('%H:%M:%S', time.strptime(crteated_at,'%a %b %d %H:%M:%S +0000 %Y'))
                    time_stages = {"time0":['00:00:00','03:00:00'], "time1":['03:00:00','06:00:00'], "time2":['06:00:00','09:00:00'], "time3" : ['09:00:00','12:00:00'], "time4":['12:00:00','15:00:00'],"time5":['15:00:00','18:00:00'],"time6":['18:00:00','21:00:00'],"time7":['21:00:00','24:00:00']}
                    for key,value in time_stages.items():
                        if during_period(ts, value[0], value[1]) == True:
                            temp[key] = temp.get(key,0) + 1

                except ValueError:
                    continue

        loc_dict[v] = temp
        print(loc_dict[v])

    json_list.append(loc_dict)

    
       
    with open("time_tweets.json",'w') as new_file:
        json_object['total_rows'] = len(json_list)
        json_object['offset'] = '666666'
        json_object['rows'] = json_list

        json.dump(json_object, new_file)

        


if __name__ == "__main__":
    period_counter(data_tweets)



