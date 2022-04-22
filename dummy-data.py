import psycopg2
import random
import time

postgres_db = psycopg2.connect(
    database = "d1b25dtb48u8jr",
    user = "gwvynzijwcgjel",
    password = "e15b68b54b4f9ecd2c8eed18a17d455cc54562336bd448304fd8e0870c28ac70",
    host = "ec2-44-199-143-43.compute-1.amazonaws.com",
    port = "5432"
)
cursor = postgres_db.cursor()

for i in range(3): #ini loopnya bisa diganti bebas
    sound = random.randint(30,40)
    temp = random.randint(36,38)
    heart = random.randint(100,150)

    cursor.execute(f"INSERT INTO bayi(suara, suhu, detak_jantung) values ({sound},{temp},{heart})")
    postgres_db.commit()
    print("Update successful")
    time.sleep(1)

