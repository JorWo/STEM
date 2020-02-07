import MySQLdb

db = MySQLdb.connect(host="localhost", user="user", passwd="password", db="students")
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
