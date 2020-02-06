from connect_nectar import ec2_my_conn

snapshot = ec2_my_conn.create_snapshot(vol.id,'instance_snapshot')

new_vol = snapshot.create_volume('melbourne-np')

ec2_my_conn.delete_snapshot(snapshot.id)
