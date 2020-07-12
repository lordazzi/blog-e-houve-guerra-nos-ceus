# Site do "E Houve Guerra nos Céus"

O código contido aqui é o utilizado no [site do E Houve Guerra nos Céus](https://ehouveguerranosceus.com.br/). Construí esta plataforma para publicar meus contos que pertencem ao Javerse, o universo de livro E Houve Guerra nos Céus. O código que estiver na master é o código que está rodando em produção.

A estrutura converte arquivos MD em arquivo HTML.

1. As infomações de cada linha dod arquivos MD são interpretadas com expressões regulares;
2. Encontrando qual a formatação da linha, outras expressões regulares são utilizadas para extrair as informações da linha;
3. Uma estrutura de metadado é formada com os dados interpretados;
4. Estes metadados são unidos a outras meta informações associadas ao artigo (título, subtítulo, autor e etc);
5. De acordo com o tipo do metadado, ele é associado a uma estrutura de template html;
6. Voi lá

A estrutura ainda é simples e não dá total suporte para toda a formação disponível pelos arquivo md, dá suporte somente às minhas necessidades e, se houverem novas necessidades, as incremento antes de publicar o artigo.

## Contribuição
Gostaria de contribuir com meu repositório? Incluir alguma nova funcionalidade? Está utilizando minha plataforma e encontrou um defeito? Então primeiro abra um issue no repositório para que eu avalie se a funcionalidade segue na direção que eu espero para o projeto. Se houver uma issue aberta e aprovada pelo dono do repositório, pode efetuar a implementação e abrir um pull request para mim.

### Pull Request
Para desenvolver a funcionalidade ou correção de defeito que deseja, primeiro crie um fork deste projeto em seu github, abra uma branch, faça as alterações que desejar e, em seguida, abra um Pull Request de seu repositório para o meu repositório, incluindo no texto do Pull Request a issue que você desenvolveu.