# Questions

For this assignment you also have to answer a couple of questions.
There is no correct answer and none is mandatory, if you don't know just skip it.

 - **What you will improve with your solution ?**
    - Add pagination for some queries
    - Add api doc like swagger

 - **What do you think of the initial project structure and how you will improve it ?**

    The initial structure was nice but mixing Domain and Entity concepts together. I refactored it to separate them more clearly :entities for persistence in Entity, pure business logic in Domain and data access in Repository.

 - **For you, what are the boundaries of a service inside a "micro-service" architecture ?**

    A service should should only own one business capability. Each service should gets its own DB and cant change anything in other service's DB. The most important stuff is keeping them independently deployable and scalable! They talk to each other through APIS or async messaging via queues. But its hard to find the balance between a monolith and managing hundreds of tiny services.


 - **For you, what are the most relevant usage for SQL, NoSQL, key-value and document store databases ?**

    I use SQL when I need transactions, complex joins, or strict consistency  where data integrity is the most important.
    NoSQL are all the others DB types, they are mostly specific to an usage where they shine
    I think key-values db Redis is more for caching/sessions, we use it when we need really fast reading.
    If by document store we are speaking of stuff like MongoDB, i don't really know where it shine atm to be honest.
    the choice of the Db depends on what youre trying to solve and how your data is structured!

