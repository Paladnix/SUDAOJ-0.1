#include <stdio.h>
#include <string.h>
int main(){
    char a[1000][17];
    int b[1000];
    char s[100];
    int i,j;
    long sum;
    int m,n;
    scanf("%d%d",&m,&n);
    for(i=0;i<m;i++){
        scanf("%s",a[i]);
        scanf("%d",&b[i]);
    }
    for(i=0;i<n;i++){
        sum=0;
        scanf("%s",s);
        while(s[0]!='.') {
            for(j=0;j<m;j++){
                if(strcmp(a[j],s)==0)sum+=b[j];
            }
            scanf("%s",s);
        }
        printf("%ld\n",sum);
    }
    return 0;
}                
    

    
