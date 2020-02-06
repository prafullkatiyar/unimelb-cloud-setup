from connect_nectar import ec2_my_conn

instanceID = ''

security_groups = ec2_my_conn.get_all_security_groups()

for sg in security_groups:
    print (sg)