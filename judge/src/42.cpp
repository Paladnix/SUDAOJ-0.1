#include <stdio.h>
#include <string.h>
int main(){
    int n,i;
    char s[5];
    int jud[11];
    int flag=0;
    for(int j=0;j<11;j++)jud[j]=0;
    while(scanf("%d",&n)){
        if(n==0)break;
        scanf("%s%s",s,s);
        if(s[0]=='o'){
            if(jud[n]!=0)flag=1;
            if(flag==1)printf("Stan is dishonest\n");
            else printf("Stan may be honest\n");
            flag=0;
            for(int j=0;j<11;j++)jud[j]=0;
            continue;
        }
        if(flag==1)continue;
        if(s[0]=='l'){
            for(i=1;i<=n;i++)
                if(jud[n]==1){
                    flag=1;
                    break;
                }    
            for(i=1;i<=n;i++)jud[i]=-1;
            continue;
        }
        if(s[0]=='h'){
            for(i=n;i<=10;i++)
                if(jud[n]==-1){
                    flag=1; 
                    break;
                }    
            for(i=n;i<=10;i++)jud[i]=1;  
        }
    }
    return 0;
}
