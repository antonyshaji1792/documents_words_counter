#!/usr/bin/env python

import textract
import os
import sys
#textract is installed in server. Veried by pip install textrect and message returned "Requirement already satisfied: pytz in /usr/lib/python2.7/site-packages (from tzlocal==1.5.1->extract-msg==0.23.1->textract) (2019.3)"

filepath = '/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input1/' + sys.argv[1]
filename =  sys.argv[1]
filenamenoext = os.path.splitext(filename)[0]
# filepath = 'sample.pdf'






docfilename =  '428f535ccf95770cdc0147ce7d2b01f0.doc'

# if docfilename[-4:] == ".doc":
#   filepath = './uploaded_files/428f535ccf95770cdc0147ce7d2b01f0.doc'
#   text = extract('./uploaded_files/428f535ccf95770cdc0147ce7d2b01f0.doc')
# else:
try:
  text = textract.process(filepath)
    # text = textract.process(str("sample.doc"))
    # text = textract.process("sample.doc").decode('utf-8')
    # text = textract.process("/var/www/vhosts/clone.tomedes.com/clone/wcnew/sample.doc")
    # print(text)
except:
  print('textract error')

# def extract(self, filepath):
#   print('extract')
#   stdout, stderr = self.run(['antiword', filepath])
#   return stdout


try:
  f = open('/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input1/' + filenamenoext + ".txt", "w+")
  # f = open("/var/www/vhosts/clone.tomedes.com/clone/wcnew/demofile2.txt", "w+")
  os.chmod("/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input1/" + filenamenoext + ".txt", 0o777)
  f.write(text)
  f.close()
except:
  print('write error')



try:
  f = open('/var/www/vhosts/tomedes.com/pro.tomedes.com/WordCount/REST/Input1/' + filenamenoext + ".txt", "r")
  # f = open(r"/var/www/vhosts/clone.tomedes.com/clone/wcnew/demofile2.txt", "r")
except:
  print('file not open and read')                

res = len(f.read().split()) 
print (str(res)) 
