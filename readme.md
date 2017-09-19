# laravel API文档
## 常规API调用原则
- 所有的API都以 'domain.com/api/...'开头
- API分为两个部分，如'domain.com/api/part_1/part_2'
    + 'part_1'为model名称，如'user'或 'question'
    + 'part_2'为行为名称，如'rest_password'
- CRUD
    + 每个model中都会有增删改查四个方法，分别对应'add'、'del'、'change'、'read'

## Model
### Question
#### 字段解释
    - 'id'
    - 'title'：标题
    - 'desc'：描述

#### 'add'
    -   权限：必须登录
    -   传参：
        +   必填：'title' (标题)
        +   可选：'desc' (描述)

#### 'change'
    -   权限：已登录且为问题所有者
    -   传参：
        +   必填：'id' (问题id)
        +   可选：'title'、'desc'