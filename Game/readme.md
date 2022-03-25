----------------

Dany jest ciąg , który zawiera tylko znaki:

'(', ')', '*'

Przykład:

"(((*))(((((*)))(*))))"

Niech długość ciągu wynosi N.

Opisuje on 1-wymiarowy świat, w którym można poruszać się w lewo i w prawo.

'(' oznacza schody w głąb jaskini (poziom - 1)

')' oznacza schody w górę (poziom + 1)

'*' oznacza skarb

Po swiecie wędruje poszukiwacz skarbów. Jego pozycję określa indeks w ciagu znaków reprezentujacym świat.

Początkowy poziom wynosi 0, początkowy indeks: -1 lub N, wedle uznania rozwiązującego zadanie.
Przesunięcie się na znak '(' lub ')' oznacza skorzystanie ze schodów. Przesunięcie się na ‘*’ nie zmienia poziomu.
Ustawienie się na indeksie spoza [0,N) nie ma żadnych skutków.

Zaimplementuj funkcje, która pomoże poszukiwaczowi skarbów poruszajacemu się zgodnie z regułami podanymi wyżej
znaleźć najmniejszy indeks należący do zbioru [0, N) taki, że:
znajduje się w nim skarb oraz na poziomie odpowiadającym temu indeksowi jest najwięcej skarbów w całym zbiorze.


Argumentem jest opisany w zadaniu ciąg znaków, a wartością zwracana szukany indeks.

----------------
Przykład:
+===============================================================================================================================================================================+
index:  |	0	|	1	|	2	|	3	|	4	|	5	|	6	|	7	|	8	|	9	|	10	|	11	|	12	|	13	|	14	|	15	|	16	|	17	|	18	|	19	|	20	|	21	|
ciąg:	|	(	|	(	|	(	|	*	|	)	|	)	|	(	|	(	|	(	|	(	|	(	|	*	|	)	|	)	|	)	|	* 	|	(	|	*	|	)	|	)	|	)	|	)	|
poziom: | 	-1	|	-2	|	-3	|	-3	|	-2	|	-1	|	-2	|	-3	|	-4	|	-5	|	-6	|	-6	|	-5	|	-4	|	-3	|	-3	|	-4	|	-4	|	-3	|	-2	|	-1	|	0 	|
+===============================================================================================================================================================================+

W powyższym przypadku szukany indeks to '3';
		
----------------