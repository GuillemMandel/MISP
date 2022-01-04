import requests
import json

def xForce(ip):
	urlXforce = "https://api.xforce.ibmcloud.com/ipr/" + ip
	
	headersXforce = {
    	'Accept': 'application/json',
    	'Authorization': 'Basic MzU0NzI1OTktZjZiNy00MmRiLTg4YmEtMzJlNjYxNjNhZDRmOjEyYWVlYjJmLTQ2OTQtNDQ5My04YWFkLWY4N2JiZjk0ZTdjYQ==',
	}
	return requests.get(url=urlXforce, headers=headersXforce).json()['history'][-1]


def abuseipdb(input):
    url = 'https://api.abuseipdb.com/api/v2/check'
    headers = {
        'Accept': 'application/json',
        'Key': 'c6e91f067193b730228ebbfb4c5f924a5317a26be3997a0601963731135641a83d6c74874856bbe1'
    }
    resultado=[]

    querystring = {'ipAddress': input, 'maxAgeInDays': '90'}
    return requests.request(method='GET', url=url, headers=headers, params=querystring).json()


def virustotal(input):
    url = 'https://www.virustotal.com/api/v3/ip_addresses/'+input
    resultado=[]
    headers = {
        'Accept': 'application/json',
        'User-Agent': 'ReadMe-API-Explorer',
        'x-apikey': '4f141e05a9d1482da1678ba43ed90d8b12dba897ba983920a19a04d9ee4ec5e1'
    }
    return requests.get(url, headers=headers).json()['data']['attributes']


def urlQuality(ip):
	urlQuality = "https://ipqualityscore.com/api/json/ip/2Qj2f51PYIoAW4AlzzJVAUGbe64tvNgk/"
	query = urlQuality + ip
	return requests.get(url=query).json()


def auth0(ip):
	headersAuth0 = {
		'accept': 'application/json',
		'x-auth-token': '21681ed7-e965-4694-8fc0-8eb892f2a9cd',
	}
	urlAuth = "https://signals.api.auth0.com/v2.0/ip/" + ip
	return requests.get(url=urlAuth, headers = headersAuth0)


def alienVault(ip):
	category = "/general"
	urlAlien = "https://otx.alienvault.cloud/api/v1/indicators/IPv4/" + ip + category
	api_headers = { "X-OTX-API-KEY" :"36e535e02008b785661000a16a0c3f4f7d96b8311484607665d3cc18d976b0e4"}
	return requests.get(url = urlAlien, headers = api_headers)