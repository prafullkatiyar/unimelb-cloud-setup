from connect_nectar import ec2_my_conn

instance_id = ''

ec2_my_conn.terminate_instances(instance_ids=["i-c6170a05", "i-f2f87040"])