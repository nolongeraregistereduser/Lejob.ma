import React from 'react';

const CvPreview = ({ formData, template }) => {
    // Helper function to parse multi-line text into arrays
    const parseTextToArray = (text) => {
        return text.split(/\r?\n/).filter(item => item.trim() !== '');
    };

    // Preview for Template 1
    const renderTemplate1 = () => {
        const skills = formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '');
        const experiences = parseTextToArray(formData.experience);
        const education = parseTextToArray(formData.education);
        const certifications = parseTextToArray(formData.certifications);
        const languages = parseTextToArray(formData.languages);
        const projects = parseTextToArray(formData.projects);

        return (
            <div className="template1-preview p-8 bg-white h-full overflow-auto">
                <div className="header bg-blue-600 text-white p-6 rounded-t-lg">
                    <h1 className="text-3xl font-bold">{formData.name || 'Your Name'}</h1>
                    <p className="text-xl mt-1">{formData.titre || 'Your Job Title'}</p>
                    <div className="contact-info mt-3 flex flex-wrap gap-4">
                        <span>{formData.email || 'your.email@example.com'}</span>
                        <span>{formData.phone || '+212 6XX-XXXXXX'}</span>
                    </div>
                </div>

                <div className="content p-6">
                    {skills.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Skills</h2>
                            <div className="flex flex-wrap gap-2">
                                {skills.map((skill, index) => (
                                    <span key={index} className="bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm">
                                        {skill}
                                    </span>
                                ))}
                            </div>
                        </div>
                    )}

                    {experiences.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Experience</h2>
                            {experiences.map((exp, index) => (
                                <div key={index} className="mb-4">
                                    <p className="text-gray-800">{exp}</p>
                                </div>
                            ))}
                        </div>
                    )}

                    {education.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Education</h2>
                            {education.map((edu, index) => (
                                <div key={index} className="mb-4">
                                    <p className="text-gray-800">{edu}</p>
                                </div>
                            ))}
                        </div>
                    )}

                    {certifications.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Certifications</h2>
                            {certifications.map((cert, index) => (
                                <div key={index} className="mb-2">
                                    <p className="text-gray-800">{cert}</p>
                                </div>
                            ))}
                        </div>
                    )}

                    {languages.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Languages</h2>
                            <div className="flex flex-wrap gap-4">
                                {languages.map((lang, index) => (
                                    <span key={index} className="text-gray-800">
                                        {lang}
                                    </span>
                                ))}
                            </div>
                        </div>
                    )}

                    {projects.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Projects</h2>
                            {projects.map((proj, index) => (
                                <div key={index} className="mb-4">
                                    <p className="text-gray-800">{proj}</p>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        );
    };

    // Preview for Template 2
    const renderTemplate2 = () => {
        const skills = formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '');
        const experiences = parseTextToArray(formData.experience);
        const education = parseTextToArray(formData.education);
        const certifications = parseTextToArray(formData.certifications);
        const languages = parseTextToArray(formData.languages);
        const projects = parseTextToArray(formData.projects);

        return (
            <div className="template2-preview h-full overflow-auto">
                <div className="header py-8 px-6 bg-gray-800 text-white text-center">
                    <h1 className="text-3xl font-bold uppercase tracking-wide">{formData.name || 'Your Name'}</h1>
                    <p className="text-xl mt-2 text-gray-300">{formData.titre || 'Your Job Title'}</p>
                </div>

                <div className="contact-info bg-gray-200 p-4 flex justify-center gap-6 flex-wrap">
                    <span className="flex items-center gap-2">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {formData.email || 'your.email@example.com'}
                    </span>
                    <span className="flex items-center gap-2">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 10h11M9 21V3m0 0L5 7m4-4l4 4" />
                        </svg>
                        {formData.phone || '+212 6XX-XXXXXX'}
                    </span>
                </div>

                <div className="content p-6">
                    {skills.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Skills</h2>
                            <ul className="list-disc list-inside">
                                {skills.map((skill, index) => (
                                    <li key={index} className="text-gray-600">{skill}</li>
                                ))}
                            </ul>
                        </div>
                    )}

                    {experiences.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Experience</h2>
                            {experiences.map((exp, index) => (
                                <p key={index} className="text-gray-600 mb-2">{exp}</p>
                            ))}
                        </div>
                    )}

                    {education.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Education</h2>
                            {education.map((edu, index) => (
                                <p key={index} className="text-gray-600 mb-2">{edu}</p>
                            ))}
                        </div>
                    )}

                    {certifications.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Certifications</h2>
                            {certifications.map((cert, index) => (
                                <p key={index} className="text-gray-600 mb-2">{cert}</p>
                            ))}
                        </div>
                    )}

                    {languages.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Languages</h2>
                            <ul className="list-disc list-inside">
                                {languages.map((lang, index) => (
                                    <li key={index} className="text-gray-600">{lang}</li>
                                ))}
                            </ul>
                        </div>
                    )}

                    {projects.length > 0 && (
                        <div className="mb-6">
                            <h2 className="text-xl font-semibold text-gray-800">Projects</h2>
                            {projects.map((proj, index) => (
                                <p key={index} className="text-gray-600 mb-2">{proj}</p>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        );
    };

    return (
        <div className="cv-preview">
            {template === 'template1' ? renderTemplate1() : renderTemplate2()}
        </div>
    );
};

export default CvPreview;
