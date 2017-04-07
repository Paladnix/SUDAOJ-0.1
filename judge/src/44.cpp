#include <stdio.h>
char s[1000001];
int next[1000001];
int main(){
    int i,j,n,t;
    while(gets(s) && s[0]!='.'){
        i=0;
        next[0]=-1;
        j=-1;
        while(s[i]!='\0'){
            if(j==-1 || s[i]==s[j]){
                ++i;
                ++j;
                next[i]=j;
                continue;
            }
            j=next[j];
        }
        n=i;
        t=n-next[n];
        if(n%t==0)printf("%d\n",n/t);
        else printf("1\n");   
    }
    return 0;
}
