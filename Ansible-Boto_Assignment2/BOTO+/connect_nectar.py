import boto.ec2
from boto.ec2.regioninfo import RegionInfo

region = RegionInfo(name='melbourne', endpoint='nova.rc.nectar.org.au')

ec2_my_conn = boto.connect_ec2(
    aws_access_key_id='94e66223c6794f1dad1dc1107c02f8df',
    aws_secret_access_key='61e1bef0941f457b984de39f657acedc',
    is_secure=True,
    region=region,
    port=8773,
    path='/services/Cloud',
    validate_certs=False
)