@extends('frontend.layouts.headerFooter')

@section('title')
    Details
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/details.css')}}">
@endpush

@section('content')
    <div class="details-section">
        <div class="row">
            <div class="col-9">
                <div class="datails-body">
                    <div class="details-topbar">
                        <div class="publish-time">
                            <p>Date : 12/12/2005</p>
                            <p>1 hour ago</p>
                        </div>
                        <div class="details-share">
                            <ul>
                                <li>
                                  <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-solid fa-link"></i></a>
                                </li>
                                <li>
                                  <a href=""><i class="fa-solid fa-share"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="details-img">
                        <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                    </div>
                    <div class="details-cat my-3">
                        <h5>Lifestyle</h5>
                    </div>
                    <div class="deatils-title">
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste fugit autem, illum eveniet explicabo quo nisi ea ad atque unde.</h3>
                    </div>
                    <div class="details-desc">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptates tempore, unde minus nulla iste labore? Magnam quis quam distinctio quisquam dolore possimus, nostrum, cupiditate ullam soluta dicta accusantium aliquam aliquid atque esse ea nemo? Consequuntur rem eveniet hic id tenetur, maiores iure dolorum officiis totam temporibus illum sit nemo omnis aperiam mollitia error ullam ut unde magni voluptatum voluptatem alias, assumenda ab doloribus. Recusandae necessitatibus vero quos, veniam labore a quo porro molestiae id enim numquam est, ipsam blanditiis natus aperiam, odit aut laboriosam minima rerum unde quis? Animi alias est id enim placeat quibusdam dolorum, atque excepturi illum similique voluptatum eos nostrum mollitia eaque ab doloribus fugiat reprehenderit nam. Explicabo numquam ea distinctio ratione! Voluptatibus amet magni sapiente cum soluta veniam ratione voluptatum. Aspernatur ad in porro recusandae! Nobis consequuntur iste recusandae laudantium rem inventore accusamus ut. Consequuntur facilis quis quam fuga, ratione itaque nulla atque debitis voluptates laudantium corrupti magnam culpa optio cumque quisquam. Officiis, incidunt doloremque. Velit expedita sint nihil impedit laborum sequi! Laborum illum corporis tenetur quia, harum libero maxime at ipsam dicta inventore beatae aliquam soluta hic ut minima. Eos ab expedita nemo facilis autem quaerat architecto eaque libero mollitia dolorem saepe unde voluptate non harum nesciunt eius iusto nisi enim eveniet totam, magnam error. Modi soluta expedita numquam iure maxime vero alias provident nostrum optio, error facere? Maxime, temporibus voluptatibus asperiores quae laborum quasi sit vero autem, cumque molestiae quisquam, aut natus consequatur iure! Non ullam fugit ab provident error dolorum quod accusamus ad, aliquam maiores deserunt architecto odit ex nulla debitis sapiente in voluptatibus accusantium dolores quis explicabo. Natus numquam enim nulla officiis dolor porro, sapiente quibusdam incidunt aperiam minima sequi, eaque quas ipsum suscipit error, similique a aspernatur. Dolor nam, numquam distinctio officiis vel natus eligendi id ab voluptatibus necessitatibus eum omnis doloremque tempore totam veritatis, velit ducimus quibusdam cum libero optio alias expedita! Reiciendis distinctio illum odio blanditiis, alias ea iure fugit doloremque provident sit dignissimos. Repellat reiciendis aspernatur necessitatibus iusto voluptates. Aliquam sed, vitae dolor dolore sapiente laboriosam soluta optio natus. Ipsa ullam, expedita suscipit iste atque ad vel nam nesciunt ex temporibus eveniet sint, necessitatibus aliquam nobis voluptatum ea maiores. Mollitia quas voluptas ut sequi modi sint, beatae, numquam cupiditate debitis, minima consectetur harum voluptatum. Magnam esse, deleniti, quaerat commodi animi veniam eum ipsa quibusdam, libero nulla enim perferendis? Eum mollitia aliquam temporibus, illum magni vel illo voluptatum nobis vitae modi ab, exercitationem iste velit dicta id expedita consequuntur laborum pariatur sed recusandae officia! Provident cumque deserunt, excepturi mollitia nostrum totam minus tenetur vero doloribus nulla pariatur esse dolorum reiciendis optio ipsam? Provident dolorem natus labore unde enim facilis ratione, quas temporibus veniam hic quis inventore accusamus, voluptatem laborum iure dolorum, ipsa reprehenderit fugiat! Facere animi eligendi voluptates nemo, nostrum provident iure nesciunt fugit assumenda maxime odio repellendus dolore! Vitae animi velit id rerum quas! Aut similique sint aperiam itaque, corrupti aliquid libero voluptatem a quasi quisquam ab reiciendis voluptatum explicabo praesentium cumque rem sed amet nisi quas!</p>
                    </div>
                </div>
                <div class="comments-section">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="comment-body">
                                <h4 class="mb-4">Leave a Reply</h4>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label">Title :</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{old('title')}}" {{$errors->has('title')?'autofocus':''}}>
                                        @error('title')<span class="text-danger">{{$message}}</span>@enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Subject :</label>
                                        <input type="text" value="{{old('subject')}}" name="subject" id="subject" class="form-control" placeholder="Enter Subject" {{$errors->has('subject')?'autofocus':''}}>
                                        @error('shortDesc') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label>Description :</label>
                                        <textarea name="description" id="description" class="form-control" rows="6" placeholder="Enter Description" {{$errors->has('description')?'autofocus':''}}>{{old('description')}}</textarea>
                                        @error('description') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-lg">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="reporter-details">
                    <div class="heading">
                        <h5>Author</h5>
                    </div>
                    <div class="details-body text-center">
                        <div class="reporter-img">
                            <img src="{{asset('assets/backend/img/user-avater.png')}}" class="img-thumbnail" alt="Creator Image">
                        </div>
                        <h3>Sagar Mondal</h3>
                        <div class="reating">
                            <h5>Reating Us</h5>
                            <ul>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                                <li><i class="fa-regular fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="details-sidebar">
                    <div class="sidebar-heading">
                      <h1>Trading News</h1>
                    </div>
                    <div class="sidebar-body">
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="details-sidebar mt-5">
                    <div class="sidebar-heading">
                      <h1>Latest News</h1>
                    </div>
                    <div class="sidebar-body">
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-news">
                                <div class="sidebar-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="sidebar-title">
                                    <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium, impedit!</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="related-news mt-5">
                <div class="mb-4">
                    <h4>Related News</h4>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-3">
                        <a href="#">
                            <div class="related-news-content">
                                <div class="content-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="content-body">
                                    <dib class="title">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium, suscipit?
                                    </dib>
                                    <div class="subtitle">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ratione, consectetur incidunt fugiat nisi exercitationem ex dolor placeat veritatis. Necessitatibus dignissimos tempore, quo fuga distinctio atque dolorum voluptate officia molestiae.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#">
                            <div class="related-news-content">
                                <div class="content-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="content-body">
                                    <dib class="title">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium, suscipit?
                                    </dib>
                                    <div class="subtitle">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ratione, consectetur incidunt fugiat nisi exercitationem ex dolor placeat veritatis. Necessitatibus dignissimos tempore, quo fuga distinctio atque dolorum voluptate officia molestiae.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#">
                            <div class="related-news-content">
                                <div class="content-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="content-body">
                                    <dib class="title">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium, suscipit?
                                    </dib>
                                    <div class="subtitle">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ratione, consectetur incidunt fugiat nisi exercitationem ex dolor placeat veritatis. Necessitatibus dignissimos tempore, quo fuga distinctio atque dolorum voluptate officia molestiae.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="#">
                            <div class="related-news-content">
                                <div class="content-img">
                                    <img src="https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png" alt="">
                                </div>
                                <div class="content-body">
                                    <dib class="title">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium, suscipit?
                                    </dib>
                                    <div class="subtitle">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ratione, consectetur incidunt fugiat nisi exercitationem ex dolor placeat veritatis. Necessitatibus dignissimos tempore, quo fuga distinctio atque dolorum voluptate officia molestiae.
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection