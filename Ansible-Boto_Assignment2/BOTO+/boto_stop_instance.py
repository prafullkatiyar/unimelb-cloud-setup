import boto.ec2

conn = boto.ec2.connect_to_region(" ")
conn.stop_instance(instance_ids= ['ins_id1','ins_id2'])