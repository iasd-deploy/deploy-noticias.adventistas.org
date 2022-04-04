for email in emerson.apaza@adventistas.org.bo waldhemir.rios@adventistas.org.bo hubert.chambi@adventistas.org.bo emilio.espinoza@adventistas.org.bo ademir.alaro@adventistas.org.bo sergio.zabaleta@adventistas.org.bo VANESSA.CASTRO@ADVENTISTAS.EC danitza.diaz@adventistas.org sheyla.paiva@adventistas.org  jaime.vilcapoma@adventistas.org thais.suarez@adventistas.org walter.navarro@adventistas.org luis.nurena@adventistas.org yasmikpari@upeu.edu.pe deyler.vasquez@adventistas.org moises.salgado@adventistas.org samuel.mogollon@adventistas.org david.ramos@adventistas.org johon.paico@adventistas.org edicion@goodhope.org.pe christian.villon@adra.org.pe rosse.ramirez@adventistas.org bastian.fernandez@adventistas.org brian.mestre@adventistas.org cristopher.adasme@adventistas.org juan.aravena@adventistas.org kenny.rivas@adventistas.org cristopher.adonis@adventistas.org gerson.hermosilla@adventistas.org raul.salamanca@adventistas.org gerardo.reyes@adventistas.org rodrigo.montoya@adventistas.org angela.arias@nuevotiempo.cl
do
    #arr=(${email//@/ })
    #id=$(wp user get ${arr[0]} --field=ID)
    #echo $id - ${arr[0]} - $email

    id=$(wp user get ${email} --field=ID)

    echo $id - $email    

    wp user update ${id} --user_pass=pRYOt1D661Un7a4#ca2cxe --role=editor --skip-packages ---quiet
    #echo $email
done