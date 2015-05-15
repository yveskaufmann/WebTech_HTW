import copy
import re
import sys
import json

from urllib.request import Request
from urllib.request import urlopen
from urllib.request import urljoin


def read_index(lang='css'):
    index = {}
    base_url = 'https://devdocs.io/'
    request = Request(base_url + 'docs/' + lang + '/index.json')
    with urlopen(request) as response:
        index = json.loads(response.read().decode('utf-8'))

    # convert the path into a absolute url
    for entry in index['entries']:
        path = '/'.join([lang, entry['path']])
        entry['path'] = urljoin(base_url, path)
    return index

class FuzzyMatcher:
    def __init__(self, index):
        self.__index = index
        self.__query = ''
        self.__fuzzy_pattern = ''

    def find(self, query):
        self.__prepare_query(query)
        hits = []
        for entry in self.__index['entries']:
            m = re.match(self.__fuzzy_pattern, entry['name'])
            if m is None:
                continue
            hit = copy.copy(entry)
            hit['score'] = self.__calc_score_by_match(m)
            hits.append(hit)

        hits.sort(key=lambda e: e['score'], reverse=True)
        return hits

    def __calc_score_by_match(self, m):
        match_length = m.end() - m.start()
        if m.start() is 0:
            return max(66, 100 - match_length)
        else:
            return max(1, 34 - match_length)


    def __prepare_query(self, query):
        self.__query = query
        self.__normalize_query()
        self.__create_fuzzy_pattern()

    def __create_fuzzy_pattern(self):
        query_chars = [re.escape(char) for char in self.__query]
        pattern = '.*?'.join(query_chars)
        self.__fuzzy_pattern = pattern

    def __normalize_query(self):
        EMPTY_STRING = ''
        WHITESPACE_PATTERN = ' '
        self.__query = self.__query                     \
            .lower()                                    \
            .replace(WHITESPACE_PATTERN, EMPTY_STRING)  \

index = read_index('css')
matcher = FuzzyMatcher(index)
hits = matcher.find('colo')
print(hits)









