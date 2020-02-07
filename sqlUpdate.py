import MySQLdb

db = MySQLdb.connect(host="localhost", user="jorwon21", passwd="wong", db="jorwon21")
#create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "UPDATE students SET age=16 WHERE name='Joe' "

cur.execute(sql)
	
#disconnect from server
db.close()
