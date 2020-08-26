#!/usr/bin/env python
# coding: utf-8

import findspark
findspark.init()

from pyspark import SparkContext
sc = SparkContext.getOrCreate()
sc

import pyspark
from pyspark.sql import SparkSession
spark = SparkSession.builder.getOrCreate()
spark

#Connecting to our API using Python’s Requests
import json
import requests

response = requests.get("http://127.0.0.1:5001/sales")
endpoint = response.text

#Loading JSON Data into Spark Dataframe
#will pass an RDD as an argument to the read.json method
#create RDD
json_rdd  = sc.parallelize([endpoint])

#create dataframe
df = spark.read.json(json_rdd)

df.columns
df2 = df.select('units_sold','unit_price','unit_cost','total_revenue','total_cost','total_profit')
#df2.show()
#df2.describe().show()
statistic_sales = df2.describe()
statistic_sales.show()

#Write DataFrame to mysql table
statistic_sales.write.format('jdbc').options(
      url='jdbc:mysql://localhost:3306/pfasales',
      driver='com.mysql.jdbc.Driver',
      dbtable='statistic_sales',
      user='root',
      password='').mode('overwrite').save()







