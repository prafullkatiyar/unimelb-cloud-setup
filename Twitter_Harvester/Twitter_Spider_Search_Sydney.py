#!/usr/bin/env python3

import tweepy
from tweepy import OAuthHandler
import time
import datetime
from datetime import timedelta
import json
import couchdb

ckey = 'xwiGzjNQxI9rd0LsoAHmMcJpZ' #consumer key
csecret = 'o34JrEprpfE7IvBeO6OgVz7WuDscpI1C7wiJUvAo2npTDfJkbp' #consumer secret
atoken = '987955571801313281-csKhhjdgantwjzxR5JDf815qCHwCUXD' #access token
asecret = 'qTS1Um9xQC09OS8LiZ1CnXjnCNi62NvF204jEXvKEeBI4' #access secret

auth = tweepy.OAuthHandler(ckey, csecret)
auth.set_access_token(atoken, asecret)
api = tweepy.API(auth, wait_on_rate_limit=True,wait_on_rate_limit_notify=True)

if (not api):
    print ("Can't Authenticate")
    sys.exit(-1)

def search_tweets():
    date_limit = datetime.datetime.now()
    date_str = str(date_limit.year) + "-" + str(date_limit.month) + "-" + str(date_limit.day)
    while(True):
        try:
            for tweet in tweepy.Cursor(api.search, until = date_str, geocode="-33.819014,151.001974,250km", lang = "en").items():
                process_tweet(tweet)
        except Exception as e:
            print(str(e))
            time.sleep(60 * 15)
            continue

    return True

# create an authenticated connection to couchdb
user = "admin"
password = "admin"
couchserver = couchdb.Server("http://%s:%s@172.17.0.2:5984/" % (user, password))

dbname = "tweetdb_no_locations" # the name of our databse for tweets without locations
if dbname in couchserver:
    db_no_location = couchserver[dbname]
else:
    db_no_location = couchserver.create(dbname)

dbname_location = "tweetdb_with_locations" # the name of our databse for tweets with locations

if dbname_location in couchserver:
    db_with_location = couchserver[dbname_location]
else:
    db_with_location = couchserver.create(dbname_location)


def process_tweet(tweet):
    precessed_data = {}
    precessed_data["text"] = tweet.text
    precessed_data["username"] = tweet.user.screen_name
    precessed_data["tweet_id"] = tweet.id
    precessed_data["created_time"] = str(tweet.created_at - timedelta(hours=7))
    try:
        if tweet.coordinates is not None:
            precessed_data["location"] = tweet.coordinates
            print(precessed_data)
            docs = precessed_data
            db_with_location[str(tweet.id)] = docs
            return True
        else:
            print(precessed_data)
            docs = precessed_data
            db_no_location[str(tweet.id)] = docs
            return True
    except BaseException as e:
        print('Failed getting data', str(e))
            #time.sleep(5)

if __name__ == '__main__':
    search_tweets()
