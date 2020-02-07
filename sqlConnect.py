import MySQLdb

db = MySQLdb.connect(host="localhost", user="jorwon21", passwd="wong", db="jorwon21")
#Create cursor

cur = db.cursor(MySQLdb.cursors.DictCursor)

#Create table as per requirement
sql = "SELECT * from students"

cur.execute(sql)

rows = cur.fetchall()
for row in rows:
	print(row)
	
#Disconnect from server
db.close()
