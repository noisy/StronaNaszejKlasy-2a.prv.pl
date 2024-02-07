/*
Program licz¹cy id podsieci dziêki podaniu ip i maski komputera
*/
#include <iostream.h>
#include <stdio.h>
void grupowanie(char *dlugi, char *gr);
void char_na_int(char *znak, int *licz);

const int index=4;


char ip[20];
char maska[20];
char ip_gr[4][index];
char maska_gr[4][index];
int ip_licz[4];
int maska_licz[4];
int id_licz[4];

main()
{
cout<<"Podaj IP komputera:";
cin>>ip;
cout<<"Podaj maske:";
cin>>maska;

grupowanie(ip, ip_gr[0]);
grupowanie(maska, maska_gr[0]);
char_na_int(ip_gr[0], ip_licz);
char_na_int(maska_gr[0], maska_licz);

for(int i=0; i<4;i++)
{
    id_licz[i]=maska_licz[i]&ip_licz[i];
    
}
    

cout<<"Id podsieci: "<<id_licz[0]<<"."<<id_licz[1]<<"."<<id_licz[2]<<"."<<id_licz[3];

getchar();getchar();

}
/************************************************/
//funkcja GRUPOWANIE rozdziela do 4 podgrup nr. czyli wg kropek
//np. 192.168.128.16
//na:
//    192
//    168
//    128
//    16 
/************************************************/
void grupowanie(char *dlugi, char *gr)
{
    int i,j,k,l;
    l=j=0;
    for(i=k=0;k<4;k++)
    {

    do{
    *(gr+i+l)=*(dlugi+j);i++;j++;
      }
    while(*(dlugi+j)!='.'&&*(dlugi+j)!=','&&*(dlugi+j)!='\0');
        j++;i=0;l+=4;
    }
}
/************************************************/
//Funkcja CHAR_NA_INT w t³umaczy z acii na int. Przenosi je do nowej tablicy
/************************************************/
void char_na_int(char *znak, int *licz)
{
 for(int i=0;i<4;i++)
      {      
             *(licz+i)=atoi(znak+i*index);
      }
 	
} 
/*************************************************/

//  Autor: Noisy

