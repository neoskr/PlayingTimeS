## PlayingTimeS
PlayingTimeSystem | 접속시간 플러그인



## 명령어


`/접속시간 순위 (페이지)`를 입력하면 접속시간 순위를 표시합니다.
한 페이지 당 5명의 플레이어를 출력하며, 페이지를 비워두면 1 페이지를 표시합니다.

`/접속시간 확인 (유저)`를 입력하면 유저의 누적 접속시간을 표시합니다.
유저 입력 칸을 비워둔 경우 본인의 접속시간을 표시합니다.



## 플러그인 API


`PlayingTimeS::getTime (Player|string)` 플레이어의 접속시간을 int형으로 출력합니다. (데이터 미 존재시 0 출력)
`PlayingTimeS::getKoreanTime (Player|string)` 플레이어의 접속시간을 a시간 b분 c초로 출력합니다.
`PlayingTimeS::koreanTimeFormat (int)` 시간, 분, 초 단위로 변환합니다. (예: 120 -> 0시간 2분 0초)
`PlayingTimeS::updateTime (Player|string)` 플레이어의 접속시간을 갱신합니다.
`PlayingTimeS::updateAllPlayers ()` 모든 플레이어의 접속시간을 갱신합니다.


### 이 플러그인의 특별한 점


`Task` 를 사용하지 않고 접속시간을 구현했다는게 다른 플러그인과의 차별화 된 부분입니다.
